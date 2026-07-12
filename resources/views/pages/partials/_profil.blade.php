<!-- ======================================= -->
<!-- 2. Profil (Visi Misi) -->
<!-- ======================================= -->
<section id="profil" class="container mx-auto px-4 sm:px-6 lg:px-8 py-24"
         x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
    
    <!-- vvv TAMBAHAN JUDUL SECTION vvv -->
    <h2 class="text-5xl font-bold text-center tracking-tighter mb-16">
        Profil Visi Misi HIMASISTA
    </h2>
    <!-- ^^^ AKHIR TAMBAHAN ^^^ -->

    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Visi -->
            <div x-show="isVisible" 
                 x-transition:enter="transition ease-out duration-1000 delay-100" 
                 x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <h2 class="text-4xl font-bold tracking-tighter text-gray-900 mb-4">Visi Kami</h2>
                <p class="text-gray-600 text-lg">
                    {!! $settings['visi'] ?? '(Visi belum diatur di admin panel)' !!}
                </p>
            </div>
            <!-- Misi -->
            <div x-show="isVisible" 
                 x-transition:enter="transition ease-out duration-1000 delay-300" 
                 x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <h2 class="text-4xl font-bold tracking-tighter text-gray-900 mb-4">Misi Kami</h2>
                <div class="prose prose-lg text-gray-600"> 
                    {!! clean($settings['misi'] ?? '<ul><li>(Misi belum diatur di admin panel)</li></ul>') !!}
                </div>
            </div>
        </div>
    </div>
</section>