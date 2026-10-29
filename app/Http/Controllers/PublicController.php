<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Management;
use App\Models\Period;
use App\Models\Post;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Setting;

class PublicController extends Controller
{
    /**
     * Menampilkan Halaman Beranda (Landing Page)
     * Ini adalah method "borong" yang mengambil semua data.
     */
    public function home(): View
    {
        // Ambil settings tanpa peduli besar/kecil huruf pada key,
        // lalu normalisasi key hasilnya jadi lowercase biar konsisten
        // dipakai di view (mis. $settings['visi'], $settings['misi']).
        $settings = Setting::get()
                        ->filter(fn ($item) => in_array(strtolower($item->key), ['visi', 'misi', 'wa_humas_1', 'wa_humas_2']))
                        ->mapWithKeys(fn ($item) => [strtolower($item->key) => $item->value]);

        // 1. Ambil Periode Aktif
        $activePeriod = Period::where('is_active', true)->first();

        // 1b. Ambil SEMUA periode buat isi dropdown pemilih periode
        $allPeriods = Period::orderBy('start_date', 'desc')->get();

        // 2. Ambil 6 Berita Terbaru
        $latestPosts = Post::where('status', 'published')
                            ->orderBy('published_at', 'desc')
                            ->take(3)
                            ->get();

        // 3. === PERBAIKAN #1 (TAMBAHKAN INI) ===
        //    Ambil 3 Acara Terdekat
        $upcomingEvents = Event::where('status', 'upcoming')
                                ->orderBy('start_time', 'asc')
                                ->take(3)
                                ->get();
        // === AKHIR PERBAIKAN #1 ===

        // 4. Ambil 9 Foto Galeri Terbaru (buat section Galeri di homepage)
        $galleries = Gallery::orderBy('created_at', 'desc')
                            ->take(9)
                            ->get();

        // 4b. Ambil 24 Foto Galeri (khusus buat kolase background Visi Misi)
        $collageGalleries = Gallery::orderBy('created_at', 'desc')
                            ->take(24)
                            ->get();

        // 5. Variabel kosong untuk data periode
        $managementsByDivision = collect();
        $programsByDivision = collect();

        if ($activePeriod) {
            // Ambil Pengurus berdasarkan Divisi
            $managementsByDivision = $activePeriod->managements()
                                        ->orderBy('id', 'asc')
                                        ->get()
                                        ->groupBy('division');

            // Ambil Proker berdasarkan Divisi
            $programsByDivision = $activePeriod->programs()
                                        ->orderBy('division')
                                        ->orderBy('name')
                                        ->get()
                                        ->groupBy('division');
        }

        // 6. Kirim SEMUA data ke satu view
        return view('pages.home', [
            'posts' => $latestPosts,
            'events' => $upcomingEvents, // <-- PERBAIKAN #2 (TAMBAHKAN 'events')
            'galleries' => $galleries,
            'collageGalleries' => $collageGalleries,
            'period' => $activePeriod,
            'allPeriods' => $allPeriods,
            'managementsByDivision' => $managementsByDivision,
            'programsByDivision' => $programsByDivision,
            'settings' => $settings,
        ]);
    }

    /**
     * Endpoint JSON: ambil data struktur pengurus & proker
     * berdasarkan periode tertentu, dipanggil dari dropdown (AJAX).
     */
    public function getStrukturByPeriod(Period $period)
    {
        $managementsByDivision = $period->managements()
                                    ->orderBy('id', 'asc')
                                    ->get()
                                    ->groupBy('division');

        $programsByDivision = $period->programs()
                                    ->orderBy('division')
                                    ->orderBy('name')
                                    ->get()
                                    ->groupBy('division');

        return response()->json([
            'period_name' => $period->name,
            'managements' => view('pages.partials._struktur-pengurus-content', compact('managementsByDivision'))->render(),
            'programs' => view('pages.partials._program-kerja-content', compact('programsByDivision'))->render(),
        ]);
    }
    
    /**
     * Menampilkan halaman detail untuk satu Berita.
     */
    public function showPost(string $slug): View
    {
        $post = Post::where('status', 'published')
                    ->where('slug', $slug)
                    ->firstOrFail(); 

        return view('pages.post-detail', [
            'post' => $post,
        ]);
    }

    /**
     * Menampilkan halaman detail untuk satu Acara.
     */
    public function showEvent(string $slug): View
    {
        $event = Event::where('slug', $slug)
                    ->firstOrFail();

        return view('pages.event-detail', [
            'event' => $event,
        ]);
        
        // KODE YANG SALAH (ERROR #2) SUDAH DIHAPUS DARI SINI
    }

    /**
     * Menyimpan pesan dari Form Kontak.
     */
    public function storeKontak(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Contact::create($validated);

        // Kembali ke beranda, di section #kontak
        return redirect('/#kontak')
                         ->with('success', 'Pesan Anda telah terkirim!');
    }

    public function arsipBerita(): View
    {
        $posts = Post::where('status', 'published')
                        ->orderBy('published_at', 'desc')
                        ->paginate(10); // Tampilkan 9 berita per halaman

        return view('pages.arsip-berita', [
            'posts' => $posts,
        ]);
    }

    /**
     * Tampilkan halaman arsip Acara (dengan paginasi).
     */
    public function arsipAcara(): View
    {
        $events = Event::orderBy('start_time', 'desc') // Tampilkan semua (terbaru dulu)
                        ->paginate(10); // Tampilkan 9 acara per halaman

        return view('pages.arsip-acara', [
            'events' => $events,
        ]);
    }

    /**
     * Tampilkan halaman arsip Galeri (semua foto, dengan paginasi).
     */
    public function arsipGaleri(): View
    {
        $galleries = Gallery::orderBy('created_at', 'desc')
                        ->paginate(15); // 15 foto per halaman

        return view('pages.arsip-galeri', [
            'galleries' => $galleries,
        ]);
    }
}