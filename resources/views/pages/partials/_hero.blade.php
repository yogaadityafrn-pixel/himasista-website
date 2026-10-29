<!-- ======================================= -->
<!-- 1. Hero Section -->
<!-- ======================================= -->
<section id="hero" class="container mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        
        <!-- KOLOM KIRI (LOGO ANDA) -->
        <div class="reveal-left">
            
            <img src="{{ asset('images/logo.png') }}" alt="HIMSI Logo" 
                 class="w-full h-auto max-w-md mx-auto rounded-3xl"> 
        </div>

        <!-- KOLOM KANAN (TEKS & TOMBOL) -->
        <div class="reveal-right">
             
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight tracking-tighter">
                Inovasi Bertumbuh,
                <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary"
                      x-data="typewriter(['Generasi Bersatu.', 'Solusi Digital.', 'Inovasi Tanpa Batas.'])"
                      x-init="start()">
                    <span x-text="displayText"></span><span class="border-r-4 border-primary animate-pulse">&nbsp;</span>
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

<script>
    function typewriter(words) {
        return {
            displayText: '',
            wordIndex: 0,
            charIndex: 0,
            deleting: false,

            start() {
                this.type();
            },

            type() {
                const currentWord = this.words ? this.words[this.wordIndex] : words[this.wordIndex];

                if (!this.deleting) {
                    // Lagi ngetik maju
                    this.displayText = words[this.wordIndex].substring(0, this.charIndex + 1);
                    this.charIndex++;

                    if (this.charIndex === words[this.wordIndex].length) {
                        // Selesai ngetik satu kata, jeda sebentar sebelum mulai hapus
                        this.deleting = true;
                        setTimeout(() => this.type(), 1800);
                        return;
                    }
                } else {
                    // Lagi menghapus mundur
                    this.displayText = words[this.wordIndex].substring(0, this.charIndex - 1);
                    this.charIndex--;

                    if (this.charIndex === 0) {
                        this.deleting = false;
                        this.wordIndex = (this.wordIndex + 1) % words.length;
                    }
                }

                const speed = this.deleting ? 40 : 90;
                setTimeout(() => this.type(), speed);
            }
        }
    }
</script>