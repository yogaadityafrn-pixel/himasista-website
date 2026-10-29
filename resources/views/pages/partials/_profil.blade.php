<!-- ======================================= -->
<!-- 2. Profil (Visi Misi) -->
<!-- ======================================= -->
<section id="profil" class="relative pt-24 pb-48 overflow-hidden bg-gray-900">

    <!-- === Background Kolase Foto (dari Galeri) === -->
    @if($collageGalleries->count() > 0)
        <div class="absolute inset-0 overflow-hidden opacity-70"
             style="display: flex; flex-wrap: wrap; align-content: flex-start; gap: 0; width: calc(100% + 220px); right: auto;
                    filter: grayscale(100%); will-change: transform; transform: translateZ(0);">
            {{-- Foto diulang 2x biar kolase tetap penuh walau section-nya jadi tinggi banget di mobile.
                 Ukuran kotak foto PAKAI PIKSEL TETAP (bukan aspect-ratio) biar gak ketarik/gepeng
                 oleh perhitungan tinggi grid otomatis.
                 Grayscale sekarang di-apply SEKALI di container ini, bukan per-foto (lebih ringan). --}}
            @for ($i = 0; $i < 2; $i++)
                @foreach($collageGalleries as $gallery)
                    <div style="width: 200px; height: 200px; overflow: hidden; flex-shrink: 0;">
                        <img src="{{ Storage::url($gallery->image_path) }}"
                             alt=""
                             loading="lazy"
                             decoding="async"
                             style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </div>
                @endforeach
            @endfor
        </div>
    @endif

    <!-- Overlay gelap tipis biar teks tetap kebaca, tapi foto tetap kelihatan -->
    <div class="absolute inset-0 bg-gray-900/50"></div>

    <!-- === Konten (di atas background) === -->
    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8">

        <h2 class="text-5xl font-bold text-center tracking-tighter mb-16 text-white drop-shadow-lg reveal-up">
            Profil Visi Misi HIMASISTA
        </h2>

        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Visi -->
                <div class="reveal-left">
                    <h2 class="text-4xl font-bold tracking-tighter text-white mb-4 drop-shadow-lg">Visi Kami</h2>
                    <p class="text-gray-100 text-lg drop-shadow">
                        {!! $settings['visi'] ?? '(Visi belum diatur di admin panel)' !!}
                    </p>
                </div>
                <!-- Misi -->
                <div class="reveal-right">
                    <h2 class="text-4xl font-bold tracking-tighter text-white mb-4 drop-shadow-lg">Misi Kami</h2>
                    <div class="prose prose-lg prose-invert text-gray-100 drop-shadow">
                        {!! clean($settings['misi'] ?? '<ul><li>(Misi belum diatur di admin panel)</li></ul>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- === Wave Divider Animasi (gerak pelan, seamless loop) === -->
    <style>
        @keyframes wave-move-kiri {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes wave-move-kanan {
            0%   { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }
        .wave-layer-1 {
            animation: wave-move-kiri 18s linear infinite;
            will-change: transform;
        }
        .wave-layer-2 {
            animation: wave-move-kanan 25s linear infinite;
            will-change: transform;
        }
    </style>
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none pointer-events-none" style="height: 220px;">
        <!-- Lapis 1: lebih terang, gerak lebih cepat -->
        <svg class="wave-layer-1 absolute bottom-0 left-0" style="width: 200%; height: 100%;" viewBox="0 0 2800 300" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#f9fafb" fill-opacity="0.6"
                  d="M0,150 C 175,280 350,20 700,150 C 1050,280 1225,20 1400,150 C 1575,280 1750,20 2100,150 C 2275,280 2450,20 2800,150 L2800,300 L0,300 Z" />
        </svg>
        <!-- Lapis 2: solid, gerak lebih lambat & arah berlawanan -->
        <svg class="wave-layer-2 absolute bottom-0 left-0" style="width: 200%; height: 100%;" viewBox="0 0 2800 300" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#f9fafb"
                  d="M0,180 C 200,50 400,250 700,160 C 1000,80 1200,240 1400,180 C 1600,50 1800,250 2100,160 C 2400,80 2600,240 2800,180 L2800,300 L0,300 Z" />

        </svg>
    </div>
</section>