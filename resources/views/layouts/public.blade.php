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
                        rounded-full bg-primary/10 blur-[100px]" 
                aria-hidden="true">
            </div>
            <div class="absolute left-[-20rem] top-[20rem] h-[50rem] w-[50rem] 
                        rounded-full bg-secondary/10 blur-[120px]" 
                aria-hidden="true">
            </div>
            <div class="absolute left-[60%] top-[70rem] h-[60rem] w-[60rem] -translate-x-1/2 
                        rounded-full bg-primary/5 blur-[100px]" 
                aria-hidden="true">
            </div>
        </div>
        <!-- ===== NAVBAR (REVISI 3-KOLOM) ===== -->
        <header 
            x-data="{ isScrolled: false, open: false }"
            @scroll.window="isScrolled = (window.scrollY > 20)"
            :class="isScrolled ? 'bg-white/80 backdrop-blur-md shadow-sm' : 'bg-transparent'"
            class="sticky top-0 z-50 w-full transition-all duration-300 ease-out"
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
                        @guest
                           <!-- <a href="/admin" 
                            class="hidden md:inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-opacity-90">
                                Login Pengurus
                            </a>
                        @endguest -->

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
                        @endguest -->
                    </nav>
                </div>
                <!-- Akhir Panel Mobile -->

            </div>
        </header>
        
        <!-- KONTEN UTAMA -->
        <main>
            {{ $slot }}
        </main>
        
        <!-- FOOTER (REVISI: DARK MODE & JARAK) -->
        <footer class="bg-gray-900 border-t border-gray-800 mt-0"> <!-- mt-32 dihapus -->
            <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center text-gray-400"> <!-- text-gray-500 diubah -->
                <p class="text-sm">&copy; {{ date('Y') }} Himpunan Mahasiswa Sistem dan Teknologi Informasi.</p>
            </div>
        </footer>
        
    </body>
</html>

