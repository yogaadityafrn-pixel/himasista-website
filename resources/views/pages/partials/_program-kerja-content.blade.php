<div class="max-w-6xl mx-auto">
    @forelse($programsByDivision as $divisionName => $programs)
        <div class="mb-10">
            <h4 class="text-2xl font-bold text-gray-900 mb-5">{{ $divisionName }}</h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($programs as $program)
                    <div class="bg-white rounded-lg p-5 border border-gray-100 shadow-md">
                        <h5 class="font-bold text-lg text-primary">{{ $program->name }}</h5>
                        <p class="text-gray-600 text-sm mt-1">{!! clean($program->description) !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500">Belum ada program kerja untuk periode ini.</p>
    @endforelse
</div>