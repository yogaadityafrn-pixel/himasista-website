<!-- ======================================= -->
<!-- 5. Organisasi (Proker & Manajemen) -->
<!-- ======================================= -->
<section id="proker" class="bg-white py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{ activeTab: 'manajemen' }">
        
        <h2 class="text-5xl font-bold text-center tracking-tighter mb-4">Struktur Kepengurusan dan Proker Organisasi</h2>
        <p class="text-center text-xl font-semibold text-gray-900 mb-10 tracking-wide">
            {{ $period ? $period->name : 'Periode Saat Ini' }}
        </p>
        
        <div class="flex justify-center mb-12">
            <div class="flex p-1 bg-gray-200 rounded-lg">
                <button @click="activeTab = 'manajemen'" 
                        :class="activeTab === 'manajemen' ? 'bg-white text-primary shadow' : 'text-gray-600'"
                        class="px-6 py-2 text-sm font-medium rounded-md transition-all">
                    Struktur Pengurus
                </button>
                <button @click="activeTab = 'proker'" 
                        :class="activeTab === 'proker' ? 'bg-white text-primary shadow' : 'text-gray-600'"
                        class="px-6 py-2 text-sm font-medium rounded-md transition-all">
                    Program Kerja
                </button>
            </div>
        </div>

        @if($period)
            <!-- === Konten Tab 1: Struktur Pengurus === -->
            <div x-show="activeTab === 'manajemen'">
                <div class="max-w-6xl mx-auto">
                    @foreach($managementsByDivision as $divisionName => $managements)
                        <div class="mb-12">
                            <h4 class="text-2xl font-bold text-gray-900 mb-6">{{ $divisionName }}</h4>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                                @foreach($managements as $management)
                                    <!-- Kartu Portrait Baru -->
                                    <div class="w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 
                                                transform hover:-translate-y-1 transition-all duration-300">
                                        <img loading="lazy" src="{{ $management->photo ? Storage::url($management->photo) : 'https://ui-avatars.com/api/?name='.urlencode($management->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                             alt="{{ $management->name }}" 
                                             class="w-full h-64
                                                    object-cover 
                                                    grayscale 
                                                    transition-all duration-300 ease-in-out
                                                    hover:grayscale-0 
                                                    hover:scale-105">
                                        <div class="p-4 text-center">
                                            <h5 class="font-semibold text-gray-900 truncate">{{ $management->name }}</h5>
                                            <p class="text-sm text-primary">{{ $management->position }}</p>

                                            <!-- Ikon Sosmed (dari PR sebelumnya) -->
                                            <div class="flex justify-center items-center space-x-3 mt-2">
                                                @if($management->instagram_url)
                                                    <a href="{{ $management->instagram_url }}" target="_blank" class="text-gray-400 hover:text-pink-500 transition-colors">
                                                        <span class="sr-only">Instagram</span>
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2.315a4.88 4.88 0 014.88 4.88v9.61a4.88 4.88 0 01-4.88 4.88h-9.61a4.88 4.88 0 01-4.88-4.88v-9.61a4.88 4.88 0 014.88-4.88h9.61zm-1.121 4.316a.75.75 0 10-1.06 1.06l2.096 2.096a.75.75 0 001.06-1.06l-2.096-2.096zm-2.14 5.303a3.25 3.25 0 106.5 0 3.25 3.25 0 00-6.5 0zm3.25-1.75a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" clip-rule="evenodd" /></svg>
                                                    </a>
                                                @endif
                                                @if($management->linkedin_url)
                                                    <a href="{{ $management->linkedin_url }}" target="_blank" class="text-gray-400 hover:text-blue-700 transition-colors">
                                                        <span class="sr-only">LinkedIn</span>
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.103 3H4.897C3.849 3 3 3.849 3 4.897v14.206C3 20.151 3.849 21 4.897 21h14.206c1.048 0 1.897-.849 1.897-1.897V4.897C21 3.849 20.151 3 19.103 3zM8.339 18.337H5.667v-8.59h2.672v8.59zM7.004 8.574a1.574 1.574 0 11-.001-3.148 1.574 1.574 0 01.001 3.148zM18.338 18.337h-2.67V14.16c0-.996-.018-2.277-1.388-2.277-1.388 0-1.601 1.086-1.601 2.206v4.248h-2.67V9.747h2.56v1.17h.037c.356-.675 1.227-1.387 2.524-1.387 2.7 0 3.198 1.778 3.198 4.091v4.716z" clip-rule="evenodd" /></svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- === Konten Tab 2: Program Kerja === -->
            <div x-show="activeTab === 'proker'" style="display: none;">
                <div class="max-w-6xl mx-auto">
                    @foreach($programsByDivision as $divisionName => $programs)
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
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-center text-gray-500">Struktur organisasi dan proker belum dipublikasi.</p>
        @endif
</section>