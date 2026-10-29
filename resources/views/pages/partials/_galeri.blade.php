<!-- ======================================= -->
<!-- 4.5. Galeri -->
<!-- ======================================= -->
<section id="galeri" class="bg-gray-50 py-24"
         x-data="{ 
            isVisible: false, 
            showModal: false, 
            modalImage: '', 
            modalCaption: '' 
         }" 
         x-intersect:enter.margin.-10%="isVisible = true" x-intersect:leave.margin.-10%="isVisible = false">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-bold text-center tracking-tighter mb-16 reveal-up">Galeri Kegiatan</h2>
    </div>

    <style>
        @keyframes galeri-scroll-kanan {
            0%   { transform: translateX(-50%); }
            100% { transform: translateX(0%); }
        }
        @keyframes galeri-scroll-kiri {
            0%   { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .galeri-track-kanan {
            animation: galeri-scroll-kanan 150s linear infinite;
        }
        .galeri-track-kiri {
            animation: galeri-scroll-kiri 150s linear infinite;
        }
        .galeri-track-kanan:hover,
        .galeri-track-kiri:hover {
            animation-play-state: paused;
        }
    </style>

    @if($galleries->count() > 0)
        <!-- Strip foto full-bleed (SENGAJA DI LUAR .container biar nempel ke tepi layar) -->
        <div class="w-full overflow-hidden space-y-2">
            <!-- Baris atas: jalan ke KANAN -->
            <div class="flex whitespace-nowrap w-max galeri-track-kanan">
                @for ($i = 0; $i < 2; $i++)
                    @foreach($galleries as $gallery)
                        <div class="overflow-hidden cursor-pointer shrink-0"
                             style="height: 220px;"
                             @click="showModal = true;
                                     modalImage = '{{ Storage::url($gallery->image_path) }}';
                                     modalCaption = '{{ $gallery->caption ?? '' }}'">
                            <img loading="lazy" src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->caption }}"
                                 style="height: 220px; width: auto; display: block;">
                        </div>
                    @endforeach
                @endfor
            </div>

            <!-- Baris bawah: jalan ke KIRI -->
            <div class="flex whitespace-nowrap w-max galeri-track-kiri">
                @for ($i = 0; $i < 2; $i++)
                    @foreach($galleries->reverse() as $gallery)
                        <div class="overflow-hidden cursor-pointer shrink-0"
                             style="height: 220px;"
                             @click="showModal = true;
                                     modalImage = '{{ Storage::url($gallery->image_path) }}';
                                     modalCaption = '{{ $gallery->caption ?? '' }}'">
                            <img loading="lazy" src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->caption }}"
                                 style="height: 220px; width: auto; display: block;">
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada foto.</p>
    @endif

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tombol Lihat Semua Foto -->
        <div class="flex justify-center mt-12">
            <a href="{{ route('galeri.index') }}"
               class="inline-block px-8 py-3 rounded-lg border-2 border-primary text-primary font-semibold
                      hover:bg-primary hover:text-white transition-colors duration-300">
                Lihat Semua Foto &rarr;
            </a>
        </div>

        <!-- MODAL LIGHTBOX (Alpine.js) -->
        <div x-show="showModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="showModal = false"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
             style="display: none;">

            <div @click.away="showModal = false" 
                 x-show="showModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="relative bg-white rounded-lg shadow-2xl max-w-3xl w-full p-4">
                
                <button @click="showModal = false" class="absolute -top-3 -right-3 bg-white rounded-full p-1 text-gray-700 hover:text-red-500 z-10 shadow">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <img :src="modalImage" alt="Gambar Galeri" class="w-full h-auto max-h-[80vh] object-contain rounded-md mb-2">
                
                <p x-text="modalCaption" class="text-center text-gray-700"></p>
            </div>
        </div>
    </div>
    
</section>