<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Post;
use App\Models\Event;
use App\Models\Contact;
use App\Models\Period;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // --- LOGIKA BARU UNTUK PERIODE AKTIF ---
        $activePeriod = Period::where('is_active', true)->first();
        
        // Siapkan nama periode, beri fallback jika belum ada
        $periodName = $activePeriod ? $activePeriod->name : 'Belum Diatur';

        // Tentukan warna: 'success' (hijau) jika ada, 'danger' (merah) jika tidak
        $periodColor = $activePeriod ? 'success' : 'danger';

        // Hitung jumlah pesan baru
        $newMessages = Contact::where('is_read', false)->count();

        return [
            // --- KARTU UNTUK PERIODE AKTIF ---
            // Stat 0: Periode Aktif (Kita taruh di paling kiri)
            Stat::make('Periode Aktif Saat Ini', $periodName)
                ->description('Periode yang tampil di website publik')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color($periodColor),
            // --- AKHIR KARTU BARU ---

            // Stat 1: Total Berita
            Stat::make('Total Berita', Post::count())
                ->description('Jumlah semua berita yang ada')
                ->icon('heroicon-o-document-text'),
            
            // Stat 2: Acara Terdekat
            Stat::make('Acara Terdekat', Event::where('status', 'upcoming')->count())
                ->description('Jumlah acara yang akan datang')
                ->icon('heroicon-o-calendar-days'),
            
            // Stat 3: Pesan Masuk
            Stat::make('Pesan Belum Dibaca', $newMessages)
                ->description('Pesan baru dari form kontak')
                ->icon('heroicon-o-inbox')
                // Beri warna 'danger' jika ada pesan baru
                ->color($newMessages > 0 ? 'danger' : 'success'),
        ];
    }
}