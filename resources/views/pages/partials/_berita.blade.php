<!-- ======================================= -->
<!-- 3. Berita Terbaru -->
<!-- ======================================= -->
<section id="berita" class="bg-gray-50 py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
        
        <h2 class="text-5xl font-bold text-center tracking-tighter mb-16">Berita Terbaru</h2>
        
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($posts as $post)
                    <div x-show="isVisible"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 translate-y-6"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="transition-delay: {{ $loop->index * 150 }}ms"
                         class="flex flex-col bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform hover:-translate-y-1 transition-all duration-300">
                        
                        <img loading="lazy" src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        
                        <div class="p-6 flex flex-col flex-1">
                            <span class="text-sm text-gray-500">{{ $post->published_at->format('d F Y') }}</span>
                            <h3 class="text-xl font-bold my-2 text-gray-900">
                                <a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 flex-1">
                                {!! \Illuminate\Support\Str::limit(strip_tags($post->content), 100, '...') !!}
                            </p>
                            <a href="{{ route('berita.show', $post->slug) }}" class="font-semibold text-primary hover:text-secondary">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Lihat Semua -->
            <div class="text-center mt-12">
                <a href="{{ route('berita.index') }}" 
                   class="px-6 py-3 text-base font-medium text-white bg-primary rounded-lg shadow-lg hover:bg-opacity-90 transform hover:-translate-y-0.5 transition-all">
                    Lihat Semua Berita &rarr;
                </a>
            </div>

        @else
            <p class="text-center text-gray-500">Belum ada berita.</p>
        @endif
    </div>
</section>