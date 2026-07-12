<x-public-layout>
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
                {{ $post->title }}
            </h1>

            <div class="mb-6 text-gray-600 text-sm">
                Ditulis oleh <span class="font-medium">{{ $post->user->name }}</span>
                pada {{ $post->published_at->format('d F Y') }}
            </div>

            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full rounded-2xl shadow-lg mb-8 aspect-video object-cover">

            <div class="prose prose-lg max-w-none prose-indigo">
                {!! clean($post->content) !!}
            </div>

            <a href="{{ route('home') }}#berita" class="text-blue-600 hover:text-blue-800 font-medium text-sm mt-12 inline-block">
                &larr; Kembali ke Daftar Berita
            </a>

        </div>
    </div>
</x-public-layout>