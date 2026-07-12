<!-- ======================================= -->
<!-- 6. Kontak -->
<!-- ======================================= -->
<section id="kontak" class="bg-gray-50 pt-24 pb-12">
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl"
         x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
        
        <div x-show="isVisible" x-transition:enter="transition ease-out duration-1000" 
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

            <h2 class="text-5xl font-bold text-center tracking-tighter mb-10 text-gray-900">Hubungi Kami</h2>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-16 items-start">
                
                <!-- KOLOM KIRI (TEKS) - 2 Kolom -->
                <div class="pt-4 md:col-span-2">
                    <h3 class="text-3xl font-bold text-primary mb-5 tracking-tight">
                        Saluran Komunikasi Resmi
                    </h3>
                    <p class="text-gray-700 text-lg leading-relaxed mb-4">
                        Kami membuka ruang komunikasi untuk <span class="font-semibold text-gray-900">Kolaborasi, Kemitraan,</span> 
                        serta <span class="font-semibold text-gray-900">Masukan yang membangun.</span>  
                    </p>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Setiap pesan yang diterima akan ditinjau untuk ditindaklanjuti.  
                        Kami berkomitmen memberikan tanggapan dengan cepat dan profesional.
                    </p>

                    <!-- Info Kontak WA (Dinamis) -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h4 class="font-semibold text-primary text-lg mb-3">
                            Hubungi Humas Kami
                        </h4>
                        <ul class="text-gray-700 text-base space-y-2">
                            <li>
                                <span class="font-medium">Humas 1:</span> 
                                @if(isset($settings['wa_humas_1']) && $settings['wa_humas_1'])
                                    <a href="https://wa.me/62{{ $settings['wa_humas_1'] }}" target="_blank" 
                                       class="text-primary hover:underline">+62 {{ $settings['wa_humas_1'] }}</a>
                                @else
                                    <span class="text-gray-400">(Belum diatur)</span>
                                @endif
                            </li>
                            <li>
                                <span class="font-medium">Humas 2:</span> 
                                @if(isset($settings['wa_humas_2']) && $settings['wa_humas_2'])
                                    <a href="https://wa.me/62{{ $settings['wa_humas_2'] }}" target="_blank" 
                                       class="text-primary hover:underline">+62 {{ $settings['wa_humas_2'] }}</a>
                                @else
                                    <span class="text-gray-400">(Belum diatur)</span>
                                @endif
                            </li>
                        </ul>
                    </div>

                    <p class="text-gray-600 text-lg mt-6 italic">
                        Salam hangat,<br>
                        <span class="font-semibold text-gray-900">#UNTAGSURABAYA #SISTEKIN #HIMASISTA</span>
                    </p>
                </div>

                <!-- KOLOM KANAN (FORM) - 3 Kolom -->
                <div class="md:col-span-3">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('kontak.store') }}" method="POST" 
                          class="space-y-5 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" required 
                                   class="mt-1 block w-full rounded-lg shadow-sm focus:border-primary focus:ring-primary
                                          {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" required
                                   class="mt-1 block w-full rounded-lg shadow-sm focus:border-primary focus:ring-primary
                                          {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                                   value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subjek</label>
                            <input type="text" name="subject" id="subject" required
                                   class="mt-1 block w-full rounded-lg shadow-sm focus:border-primary focus:ring-primary
                                          {{ $errors->has('subject') ? 'border-red-500' : 'border-gray-300' }}"
                                   value="{{ old('subject') }}">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea name="message" id="message" rows="4" required
                                      class="mt-1 block w-full rounded-lg shadow-sm focus:border-primary focus:ring-primary
                                             {{ $errors->has('message') ? 'border-red-500' : 'border-gray-300' }}">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="w-full px-6 py-3 text-base font-medium text-white bg-primary rounded-lg shadow-md hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

            </div>
        </div>
</section>