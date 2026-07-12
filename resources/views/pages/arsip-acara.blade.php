<x-public-layout>
    <section id="hero-arsip" class="relative bg-primary text-white py-24 px-4 sm:px-6 lg:px-8">
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">
                Arsip Acara
            </h1>
            <p class="mt-4 text-lg text-blue-100 max-w-2xl mx-auto">
                Jejak langkah dan semua kegiatan yang telah kami selenggarakan.
            </p>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($events->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach($events as $event)
                        <div class="flex flex-col bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 
                                    transform hover:-translate-y-1 transition-all duration-300">
                            
                            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                            
                            <div class="p-6 flex flex-col flex-1">
                                <span class="text-sm font-semibold 
                                    {{ $event->start_time->isFuture() ? 'text-primary' : 'text-gray-500' }}">
                                    {{ $event->start_time->format('d F Y, H:i') }} WIB
                                </span>
                                <h3 class="text-xl font-bold my-2 text-gray-900">
                                    <a href="{{ route('acara.show', $event->slug) }}">{{ $event->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 flex-1">
                                    <span class="font-medium">Lokasi:</span> {{ $event->location ?? 'N/A' }}
                                </p>
                                <a href="{{ route('acara.show', $event->slug) }}" class="font-semibold text-secondary hover:text-primary">
                                    Lihat Detail &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16 max-w-6xl mx-auto">
                    {{ $events->links() }}
                </div>

            @else
                <p class="text-center text-gray-500">Belum ada acara yang dipublikasi.</p>
            @endif
        </div>
    </section>
</x-public-layout>