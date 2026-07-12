<x-public-layout>
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
                {{ $event->title }}
            </h1>

            <div class="mb-6 text-gray-700">
                <p><strong>Tanggal:</strong> {{ $event->start_time->format('d F Y') }}</p>
                <p><strong>Waktu:</strong> {{ $event->start_time->format('H:i') }} WIB - Selesai</p>
                <p><strong>Lokasi:</strong> {{ $event->location ?? 'N/A' }}</p>
            </div>

            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full rounded-2xl shadow-lg mb-8 aspect-video object-cover">

            <div class="prose prose-lg max-w-none prose-indigo">
                {!! clean($event->description) !!}
            </div>

            <a href="{{ route('home') }}#acara" class="text-blue-600 hover:text-blue-800 font-medium text-sm mt-12 inline-block">
                &larr; Kembali ke Daftar Acara
            </a>

        </div>
    </div>
</x-public-layout>