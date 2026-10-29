<x-public-layout>
    <section id="hero-arsip" class="relative bg-primary text-white py-24 px-4 sm:px-6 lg:px-8">
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">
                Galeri Kegiatan
            </h1>
            <p class="mt-4 text-lg text-blue-100 max-w-2xl mx-auto">
                Semua dokumentasi kegiatan dan momen HIMASISTA.
            </p>
        </div>
    </section>

    <section class="py-24 bg-gray-50"
             x-data="{ showModal: false, modalImage: '', modalCaption: '' }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            @if($galleries->count() > 0)
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                        @foreach($galleries as $gallery)
                            <div class="rounded-xl overflow-hidden shadow-lg cursor-pointer aspect-square"
                                 @click="showModal = true;
                                         modalImage = '{{ Storage::url($gallery->image_path) }}';
                                         modalCaption = '{{ $gallery->caption ?? '' }}'">
                                <img loading="lazy" src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->caption }}"
                                     class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-16 max-w-6xl mx-auto">
                    {{ $galleries->links() }}
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada foto.</p>
            @endif

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
</x-public-layout>