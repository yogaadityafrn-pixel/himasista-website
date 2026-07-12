<!-- ======================================= -->
<!-- 1. Hero Section -->
<!-- ======================================= -->
<section id="hero" class="container mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24"
         x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        
        <!-- KOLOM KIRI (LOGO ANDA) -->
        <div x-show="isVisible" 
             x-transition:enter="transition ease-out duration-1000" 
             x-transition:enter-start="opacity-0 -translate-x-8" 
             x-transition:enter-end="opacity-100 translate-x-0">
            
            <img src="{{ asset('images/logo.png') }}" alt="HIMSI Logo" 
                 class="w-full h-auto max-w-md mx-auto rounded-3xl"> 
        </div>

        <!-- KOLOM KANAN (TEKS & TOMBOL) -->
        <div x-show="isVisible" 
             x-transition:enter="transition ease-out duration-1000 delay-200" 
             x-transition:enter-start="opacity-0 translate-x-8" 
             x-transition:enter-end="opacity-100 translate-x-0">
             
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight tracking-tighter">
                Inovasi Bertumbuh,
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
                    Generasi Bersatu.
                </span>
            </h1>
            <p class="mt-8 text-lg md:text-xl text-gray-600">
                Selamat datang di platform digital resmi HIMASISTA (Himpunan Mahasiswa Sistem dan Teknologi Informasi).
            </p>
            <div class="mt-10 flex flex-wrap justify-start gap-4">
                <a href="#profil" class="px-8 py-3 text-base font-medium text-white bg-primary rounded-lg shadow-lg hover:bg-opacity-90 transform hover:-translate-y-0.5 transition-all">
                    Jelajahi Profil
                </a>
                <a href="#kontak" class="px-8 py-3 text-base font-medium text-primary bg-gray-100 rounded-lg hover:bg-gray-200 transition-all">
                    Hubungi Kami
                </a>
            </div>
        </div>

    </div>
</section>