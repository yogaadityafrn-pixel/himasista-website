<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <!-- Judul Halaman -->
            <title>{{ config('app.name', 'HIMASISTA') }} - Himpunan Mahasiswa Sistem & Teknologi Informasi</title>

            <!-- Favicon -->
            <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

            <!-- Meta Tag SEO & Share -->
            <meta name="description" content="Website resmi Himpunan Mahasiswa Sistem dan Teknologi Informasi (HIMASISTA) UNTAG Surabaya. Platform inovasi, kolaborasi, dan informasi.">
            <meta name="keywords" content="HIMASISTA, UNTAG, Surabaya, Sistem Informasi, Teknologi Informasi, Himpunan Mahasiswa">
            <meta name="author" content="HIMASISTA UNTAG Surabaya">
            <meta property="og:title" content="HIMASISTA UNTAG Surabaya">
            <meta property="og:description" content="Website resmi Himpunan Mahasiswa Sistem dan Teknologi Informasi. Platform inovasi, kolaborasi, dan informasi.">
            <meta property="og:type" content="website">
            <meta property="og:url" content="{{ url('/') }}">
            <meta property="og:image" content="{{ asset('images/og-image.png') }}">
            <meta property="og:image:width" content="1200">
            <meta property="og:image:height" content="630">
            <meta name="twitter:card" content="summary_large_image"> <!-- <-- TYPO DIPERBAIKI DI SINI -->
            <meta name="twitter:title" content="HIMASISTA UNTAG Surabaya">
            <meta name="twitter:description" content="Website resmi Himpunan Mahasiswa Sistem dan Teknologi Informasi.">
            <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">
            
            <!-- Font Inter -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
            
            <!-- Vite (CSS & JS) -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
    
    <body class="font-sans antialiased bg-white text-gray-900">

        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute left-[50%] top-[-10rem] h-[40rem] w-[80rem] -translate-x-1/2 
                        rounded-full bg-primary/10 blur-[100px] will-change-transform" 
                aria-hidden="true">
            </div>
            <div class="absolute left-[-20rem] top-[20rem] h-[50rem] w-[50rem] 
                        rounded-full bg-secondary/10 blur-[120px] will-change-transform" 
                aria-hidden="true">
            </div>
            <div class="absolute left-[60%] top-[70rem] h-[60rem] w-[60rem] -translate-x-1/2 
                        rounded-full bg-primary/5 blur-[100px] will-change-transform" 
                aria-hidden="true">
            </div>
        </div>
        <!-- ===== RUNNING TEXT / MARQUEE ===== -->
        <style>
            @keyframes himasista-marquee {
                0%   { transform: translateX(0%); }
                100% { transform: translateX(-50%); }
            }
            .himasista-marquee-track {
                animation: himasista-marquee 20s linear infinite;
            }
        </style>
        <div class="w-full bg-gradient-to-r from-primary via-primary to-secondary text-white overflow-hidden">
            <div class="flex whitespace-nowrap py-2 w-max himasista-marquee-track">
                @for ($i = 0; $i < 8; $i++)
                    <span class="flex items-center shrink-0 text-sm font-medium pr-3">
                        Nantikan berbagai
                        <a href="https://www.instagram.com/GANTI_DENGAN_USERNAME_IG_HIMASISTA"
                           target="_blank" rel="noopener"
                           class="font-bold underline hover:text-gray-100 mx-1">Event</a>
                        seru HIMASISTA dengan selalu mengikuti akun media sosial dan website kami!
                        <span class="mx-6 opacity-60">•</span>
                    </span>
                @endfor
            </div>
        </div>

        <!-- ===== NAVBAR (REVISI 3-KOLOM) ===== -->
        <header 
            x-data="{ isScrolled: false, open: false, show: true, lastY: 0 }"
            @scroll.window="
                let y = window.scrollY;
                isScrolled = (y > 20);
                show = (y < lastY || y < 80);
                lastY = y;
            "
            :class="isScrolled ? 'bg-white/80 backdrop-blur-md shadow-sm' : 'bg-transparent'"
            :style="show ? 'transform: translateY(0)' : 'transform: translateY(-100%)'"
            class="sticky top-0 z-50 w-full transition-all duration-300 ease-in-out"
        >
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Wrapper utama (3 kolom flex) -->
                <div class="flex justify-between items-center h-20">
                    
                    <!-- Kolom 1: Logo -->
                    <div class="flex-1">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <img src="{{ asset('images/logo.png') }}" alt="HIMASISTA Logo" class="h-10 w-auto">
                            <span class="font-bold text-lg text-primary">HIMASISTA</span>
                        </a>
                    </div>

                    <!-- Kolom 2: Navigasi (desktop) -->
                    <nav class="hidden md:flex flex-auto justify-center space-x-8">
                        <a href="#profil" class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Profil</a>
                        <a href="#berita" class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Berita</a>
                        <a href="#acara" class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Acara</a>
                        <a href="#galeri" class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Galeri</a>
                        <a href="#proker" class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Struktur / Proker</a>
                        <a href="#kontak" class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Kontak</a>
                    </nav>

                    <!-- Kolom 3: Login & Hamburger (kanan) -->
                    <div class="flex-1 flex justify-end items-center">
                       <!-- @guest
                            <a href="/admin" 
                            class="hidden md:inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-opacity-90">
                                Login Pengurus
                            </a>
                        @endguest

                        <!-- Tombol Hamburger (mobile only) -->
                        <div class="md:hidden ml-4">
                            <button @click="open = !open" 
                                    class="text-gray-600 hover:text-primary focus:outline-none">
                                <span class="sr-only">Buka menu</span>

                                <!-- Ikon Hamburger -->
                                <svg :class="{ 'hidden': open, 'inline-flex': !open }" 
                                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>

                                <!-- Ikon Close (X) -->
                                <svg :class="{ 'hidden': !open, 'inline-flex': open }" 
                                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Panel Menu Mobile -->
                <div 
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="md:hidden"
                    style="display: none;"
                    @click.away="open = false"
                >
                    <nav class="pt-4 pb-4 space-y-2 border-t border-gray-200">
                        <a href="#profil" @click="open = false" 
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">Profil</a>
                        <a href="#berita" @click="open = false" 
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">Berita</a>
                        <a href="#acara" @click="open = false" 
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">Acara</a>
                        <a href="#galeri" @click="open = false" 
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">Galeri</a>
                        <a href="#proker" @click="open = false" 
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">Struktur / Proker</a>
                        <a href="#kontak" @click="open = false" 
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg">Kontak</a>

                      <!--  @guest
                            <div class="pt-2">
                                <a href="/admin" 
                                class="block w-full px-3 py-3 text-base font-medium text-center text-white bg-primary rounded-lg shadow">
                                    Login Pengurus
                                </a>
                            </div>
                        @endguest
                    </nav>
                </div>
                <!-- Akhir Panel Mobile -->

            </div>
        </header>
        
        <!-- KONTEN UTAMA -->
        <main>
            {{ $slot }}
        </main>
        
        <!-- FOOTER (REVISI: Full Footer ala HIMASIS, dengan background titik animasi) -->
        <footer class="relative bg-gray-900 border-t border-gray-800 mt-0 overflow-hidden">

            <!-- Background dekoratif: particle network beneran gerak (canvas), titik & garis nyambung otomatis -->
            <canvas id="footer-particle-canvas" style="position: absolute; inset: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>

            <script>
                (function () {
                    function setupParticleCanvas() {
                        const canvas = document.getElementById('footer-particle-canvas');
                        if (!canvas) return;
                        const ctx = canvas.getContext('2d');
                        const footer = canvas.parentElement;
                        let particles = [];
                        let animationId;

                        function resizeCanvas() {
                            canvas.width = footer.offsetWidth;
                            canvas.height = footer.offsetHeight;
                        }

                        function createParticles() {
                            const count = Math.max(20, Math.floor((canvas.width * canvas.height) / 40000));
                            particles = Array.from({ length: count }, () => ({
                                x: Math.random() * canvas.width,
                                y: Math.random() * canvas.height,
                                vx: (Math.random() - 0.5) * 0.3,
                                vy: (Math.random() - 0.5) * 0.3,
                            }));
                        }

                        function animate() {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);

                            particles.forEach(p => {
                                p.x += p.vx;
                                p.y += p.vy;
                                if (p.x <= 0 || p.x >= canvas.width) p.vx *= -1;
                                if (p.y <= 0 || p.y >= canvas.height) p.vy *= -1;
                            });

                            const maxDist = 160;
                            for (let i = 0; i < particles.length; i++) {
                                for (let j = i + 1; j < particles.length; j++) {
                                    const dx = particles[i].x - particles[j].x;
                                    const dy = particles[i].y - particles[j].y;
                                    const dist = Math.sqrt(dx * dx + dy * dy);
                                    if (dist < maxDist) {
                                        ctx.strokeStyle = `rgba(148, 163, 184, ${0.25 * (1 - dist / maxDist)})`;
                                        ctx.lineWidth = 1;
                                        ctx.beginPath();
                                        ctx.moveTo(particles[i].x, particles[i].y);
                                        ctx.lineTo(particles[j].x, particles[j].y);
                                        ctx.stroke();
                                    }
                                }
                            }

                            particles.forEach(p => {
                                ctx.beginPath();
                                ctx.arc(p.x, p.y, 2, 0, Math.PI * 2);
                                ctx.fillStyle = 'rgba(56, 189, 248, 0.8)';
                                ctx.fill();
                            });

                            animationId = requestAnimationFrame(animate);
                        }

                        function init() {
                            resizeCanvas();
                            if (canvas.width === 0 || canvas.height === 0) {
                                // Footer belum punya ukuran (belum selesai layout), coba lagi sebentar lagi
                                setTimeout(init, 200);
                                return;
                            }
                            createParticles();
                            if (animationId) cancelAnimationFrame(animationId);
                            animate();
                        }

                        window.addEventListener('resize', init);
                        init();
                    }

                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', setupParticleCanvas);
                    } else {
                        setupParticleCanvas();
                    }
                })();
            </script>

            <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">

                <!-- Quote -->
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <p class="text-xl sm:text-2xl font-semibold italic text-gray-200 leading-relaxed">
                        <span class="text-secondary text-3xl align-top">&ldquo;</span>
                        Kami mungkin tak terlihat di depan, tapi kami selalu hadir di setiap proses, memastikan setiap detail berjalan sempurna.
                        <span class="text-secondary text-3xl align-bottom">&rdquo;</span>
                    </p>
                </div>

                <!-- Kolom-kolom -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                    <!-- Kolom 1: Logo, deskripsi, sosmed -->
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center space-x-2 mb-4">
                            <img src="{{ asset('images/logo-himasista.png') }}" alt="Logo HIMASISTA" class="h-10 w-10" onerror="this.style.display='none'">
                            <span class="text-lg font-bold text-white">HIMASISTA</span>
                        </a>
                        <p class="text-sm text-gray-400 leading-relaxed mb-4">
                            HIMASISTA adalah Himpunan Mahasiswa Sistem dan Teknologi Informasi, Universitas 17 Agustus 1945 Surabaya.
                        </p>
                        <div class="flex space-x-3">
                            <a href="#" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-300 hover:bg-primary hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2.315a4.88 4.88 0 014.88 4.88v9.61a4.88 4.88 0 01-4.88 4.88h-9.61a4.88 4.88 0 01-4.88-4.88v-9.61a4.88 4.88 0 014.88-4.88h9.61zm-1.121 4.316a.75.75 0 10-1.06 1.06l2.096 2.096a.75.75 0 001.06-1.06l-2.096-2.096zm-2.14 5.303a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zm3.25-1.75a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/></svg>
                            </a>
                            <a href="#" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-300 hover:bg-primary hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.103 3H4.897C3.849 3 3 3.849 3 4.897v14.206C3 20.151 3.849 21 4.897 21h14.206c1.048 0 1.897-.849 1.897-1.897V4.897C21 3.849 20.151 3 19.103 3zM8.339 18.337H5.667v-8.59h2.672v8.59zM7.004 8.574a1.574 1.574 0 11-.001-3.148 1.574 1.574 0 01.001 3.148zM18.338 18.337h-2.67V14.16c0-.996-.018-2.277-1.388-2.277-1.388 0-1.601 1.086-1.601 2.206v4.248h-2.67V9.747h2.56v1.17h.037c.356-.675 1.227-1.387 2.524-1.387 2.7 0 3.198 1.778 3.198 4.091v4.716z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Kolom 2: Menu -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Menu</h4>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="{{ route('home') }}" class="hover:text-secondary transition-colors">Home</a></li>
                            <li><a href="#profil" class="hover:text-secondary transition-colors">Profil</a></li>
                            <li><a href="#berita" class="hover:text-secondary transition-colors">Berita</a></li>
                            <li><a href="#acara" class="hover:text-secondary transition-colors">Acara</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 3: Jelajahi -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Jelajahi</h4>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#galeri" class="hover:text-secondary transition-colors">Galeri</a></li>
                            <li><a href="#proker" class="hover:text-secondary transition-colors">Struktur / Proker</a></li>
                            <li><a href="{{ route('galeri.index') }}" class="hover:text-secondary transition-colors">Semua Foto</a></li>
                            <li><a href="#kontak" class="hover:text-secondary transition-colors">Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 4: Hubungi Kami -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Hubungi Kami</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 text-secondary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Universitas 17 Agustus 1945 Surabaya</span>
                            </li>
                            @if(!empty($settings['wa_humas_1'] ?? null))
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-secondary shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.48 2 2 6.48 2 12c0 1.868.508 3.62 1.393 5.121L2 22l4.995-1.376A9.951 9.951 0 0012.001 22C17.522 22 22 17.52 22 12S17.522 2 12.001 2zm0 18.06a8.033 8.033 0 01-4.34-1.267l-.31-.187-3.078.848.822-3.005-.202-.31A8.033 8.033 0 013.94 12c0-4.45 3.61-8.06 8.061-8.06 4.45 0 8.06 3.61 8.06 8.06 0 4.45-3.61 8.06-8.06 8.06z"/></svg>
                                    <span>+62 {{ $settings['wa_humas_1'] }}</span>
                                </li>
                            @endif
                            @if(!empty($settings['wa_humas_2'] ?? null))
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-secondary shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.48 2 2 6.48 2 12c0 1.868.508 3.62 1.393 5.121L2 22l4.995-1.376A9.951 9.951 0 0012.001 22C17.522 22 22 17.52 22 12S17.522 2 12.001 2zm0 18.06a8.033 8.033 0 01-4.34-1.267l-.31-.187-3.078.848.822-3.005-.202-.31A8.033 8.033 0 013.94 12c0-4.45 3.61-8.06 8.061-8.06 4.45 0 8.06 3.61 8.06 8.06 0 4.45-3.61 8.06-8.06 8.06z"/></svg>
                                    <span>+62 {{ $settings['wa_humas_2'] }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Garis pemisah + copyright -->
                <div class="border-t border-gray-800 mt-12 pt-6 text-center">
                    <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Himpunan Mahasiswa Sistem dan Teknologi Informasi.</p>
                </div>
            </div>
        </footer>

        <!-- ===== SCROLL REVEAL SYSTEM ===== -->
        <style>
            /* Base state: elemen tersembunyi sebelum masuk viewport */
            .reveal-left,
            .reveal-right,
            .reveal-up {
                opacity: 0;
                transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                            transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
                will-change: opacity, transform;
            }

            .reveal-left  { transform: translateX(-60px); }
            .reveal-right { transform: translateX(60px); }
            .reveal-up    { transform: translateY(40px); }

            /* State visible: elemen tampak di posisi asli */
            .reveal-left.is-visible,
            .reveal-right.is-visible,
            .reveal-up.is-visible {
                opacity: 1;
                transform: translate(0, 0);
            }

            /* Delay bertahap untuk elemen sejajar */
            .reveal-delay-1 { transition-delay: 0.1s; }
            .reveal-delay-2 { transition-delay: 0.2s; }
            .reveal-delay-3 { transition-delay: 0.3s; }
            .reveal-delay-4 { transition-delay: 0.4s; }
        </style>

        <script>
            (function () {
                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-visible');
                            } else {
                                // Reset agar animasi ulang saat scroll balik ke atas
                                entry.target.classList.remove('is-visible');
                            }
                        });
                    },
                    { threshold: 0.12 }
                );

                // Observe semua elemen reveal setelah DOM siap
                function initReveal() {
                    document.querySelectorAll('.reveal-left, .reveal-right, .reveal-up')
                        .forEach((el) => observer.observe(el));
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initReveal);
                } else {
                    initReveal();
                }
            })();
        </script>
        <!-- ===== END SCROLL REVEAL SYSTEM ===== -->

    </body>
</html>