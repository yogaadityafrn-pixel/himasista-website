<!-- ======================================= -->
<!-- 4. CTA (Call to Action) -->
<!-- ======================================= -->
<section id="cta" class="bg-primary py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
        
        <div x-show="isVisible" 
             x-transition:enter="transition ease-out duration-1000" 
             x-transition:enter-start="opacity-0 translate-y-6" 
             x-transition:enter-end="opacity-100 translate-y-0"
             class="max-w-3xl mx-auto text-center">
            
            <h2 class="text-4xl font-extrabold text-white tracking-tight mb-6">
                Tertarik Bergabung atau Berkolaborasi?
            </h2>
            <p class="text-lg text-blue-100 mb-8">
                Jadilah bagian dari inovasi kami. Baik sebagai anggota baru, rekan kolaborasi, atau sponsor, kami membuka pintu untuk setiap ide cemerlang.
            </p>
            <a href="#kontak" class="px-10 py-3 text-base font-medium text-primary 
                                bg-white rounded-lg shadow-lg 
                                transform hover:scale-105 transition-all">
                Hubungi Kami Sekarang
            </a>
        </div>

    </div>
</section>