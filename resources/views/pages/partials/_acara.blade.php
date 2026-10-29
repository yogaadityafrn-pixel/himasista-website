<!-- ======================================= -->
<!-- 3.5. Acara Terdekat -->
<!-- ======================================= -->
<section id="acara" class="bg-white py-24">

    <style>
        /* ===== Flip Card ===== */
        .flip-card {
            perspective: 1200px;
            height: 440px;
        }
        .flip-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.65s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .flip-inner.is-flipped {
            transform: rotateY(180deg);
        }
        .flip-front,
        .flip-back {
            position: absolute;
            inset: 0;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .flip-back {
            transform: rotateY(180deg);
        }

        /* Blurred photo background untuk sisi belakang */
        .flip-back-bg {
            position: absolute;
            inset: -12px;
            background-size: cover;
            background-position: center;
            filter: blur(10px);
            transform: scale(1.08);
        }
        .flip-back-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.82);
        }
        .flip-back-content {
            position: relative;
            z-index: 1;
            height: 100%;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Tombol close X */
        .flip-close-btn {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            z-index: 2;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background: #ef4444;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.875rem;
            cursor: pointer;
            border: none;
            line-height: 1;
            flex-shrink: 0;
            transition: background 0.2s;
        }
        .flip-close-btn:hover { background: #dc2626; }
    </style>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <h2 class="text-5xl font-bold text-center tracking-tighter mb-16 reveal-up">Acara Terdekat</h2>

        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($events as $event)
                    @php
                        $col = ($loop->iteration - 1) % 3;
                        $revealClass = $col === 0 ? 'reveal-left' : ($col === 2 ? 'reveal-right' : 'reveal-up');
                        $delayClass  = 'reveal-delay-' . (($loop->index % 3) + 1);
                        $imgUrl = Storage::url($event->image);
                    @endphp

                    <div class="flip-card {{ $revealClass }} {{ $delayClass }}">
                        <div class="flip-inner"
                             x-data="{ flipped: false }"
                             @click="flipped = !flipped"
                             :class="{ 'is-flipped': flipped }">

                            {{-- ===== DEPAN: Foto penuh ===== --}}
                            <div class="flip-front">
                                <img loading="lazy"
                                     src="{{ $imgUrl }}"
                                     alt="{{ $event->title }}"
                                     style="width:100%; height:100%; object-fit:cover; display:block;">
                            </div>

                            {{-- ===== BELAKANG: Blurred photo + info ===== --}}
                            <div class="flip-back">

                                {{-- Background foto blur --}}
                                <div class="flip-back-bg"
                                     style="background-image: url('{{ $imgUrl }}');"></div>

                                {{-- Overlay putih semi-transparan --}}
                                <div class="flip-back-overlay"></div>

                                {{-- Tombol X --}}
                                <button class="flip-close-btn"
                                        @click.stop="flipped = false"
                                        aria-label="Tutup">&#x2715;</button>

                                {{-- Konten --}}
                                <div class="flip-back-content">
                                    <h3 class="text-xl font-extrabold text-gray-900 leading-tight mb-3 pr-8">
                                        {{ $event->title }}
                                    </h3>

                                    <div class="flex items-center gap-1.5 text-xs font-semibold text-primary mb-1">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $event->start_time->format('d F Y, H:i') }} WIB
                                    </div>

                                    <div class="flex items-center gap-1.5 text-xs text-gray-600 mb-4">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $event->location ?? 'N/A' }}
                                    </div>

                                    @if($event->description)
                                    <p class="text-sm text-gray-700 leading-relaxed flex-1 overflow-hidden"
                                       style="display: -webkit-box; -webkit-line-clamp: 8; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ strip_tags($event->description) }}
                                    </p>
                                    @endif

                                    <a href="{{ route('acara.show', $event->slug) }}"
                                       @click.stop
                                       class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-primary hover:underline shrink-0">
                                        Lihat Selengkapnya &rarr;
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Lihat Semua -->
            <div class="text-center mt-12 reveal-up reveal-delay-2">
                <a href="{{ route('acara.index') }}"
                   class="px-6 py-3 text-base font-medium text-white bg-primary rounded-lg shadow-lg hover:bg-opacity-90 transform hover:-translate-y-0.5 transition-all">
                    Lihat Semua Acara &rarr;
                </a>
            </div>

        @else
            <p class="text-center text-gray-500">Tidak ada acara terdekat.</p>
        @endif
    </div>
</section>