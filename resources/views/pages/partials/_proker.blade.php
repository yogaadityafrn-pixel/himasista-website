<!-- ======================================= -->
<!-- 5. Organisasi (Proker & Manajemen) -->
<!-- ======================================= -->
<section id="proker" class="bg-white py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8"
         x-data="periodSwitcher({
            initialPeriodId: {{ $period?->id ?? 'null' }},
            initialManagementsHtml: @js($period ? view('pages.partials._struktur-pengurus-content', compact('managementsByDivision'))->render() : ''),
            initialProgramsHtml: @js($period ? view('pages.partials._program-kerja-content', compact('programsByDivision'))->render() : ''),
         })"
         x-intersect:enter.margin.-10%="isVisible = true" x-intersect:leave.margin.-10%="isVisible = false">

        <h2 class="text-5xl font-bold text-center tracking-tighter mb-4 reveal-up">Struktur Kepengurusan dan Proker Organisasi</h2>

        <!-- === Dropdown Pemilih Periode === -->
        <div class="flex justify-center mb-4">
            <select x-model="selectedPeriodId"
                    @change="loadPeriod()"
                    :disabled="loading"
                    class="border border-gray-300 rounded-lg px-4 py-2 text-sm font-semibold text-gray-900
                           focus:outline-none focus:ring-2 focus:ring-primary">
                @foreach($allPeriods as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}{{ $p->is_active ? ' (Aktif)' : '' }}</option>
                @endforeach
            </select>
        </div>

        <p class="text-center text-xl font-semibold text-gray-900 mb-10 tracking-wide" x-text="periodName"></p>

        <div class="flex justify-center mb-12">
            <div class="flex p-1 bg-gray-200 rounded-lg">
                <button @click="activeTab = 'manajemen'"
                        x-show="isVisible"
                        x-transition:enter="transition ease-out duration-[1000ms]"
                        x-transition:enter-start="opacity-0 -translate-x-16"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        :class="activeTab === 'manajemen' ? 'bg-white text-primary shadow' : 'text-gray-600'"
                        class="px-6 py-2 text-sm font-medium rounded-md transition-all">
                    Struktur Pengurus
                </button>
                <button @click="activeTab = 'proker'"
                        x-show="isVisible"
                        x-transition:enter="transition ease-out duration-[1000ms]"
                        x-transition:enter-start="opacity-0 translate-x-16"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        :class="activeTab === 'proker' ? 'bg-white text-primary shadow' : 'text-gray-600'"
                        class="px-6 py-2 text-sm font-medium rounded-md transition-all">
                    Program Kerja
                </button>
            </div>
        </div>

        <!-- Indikator loading pas lagi fetch data periode lain -->
        <div x-show="loading" class="text-center text-gray-400 mb-6">Memuat data periode...</div>

        <div x-show="!loading">
            <!-- === Konten Tab 1: Struktur Pengurus === -->
            <div x-show="activeTab === 'manajemen'" x-html="managementsHtml"></div>

            <!-- === Konten Tab 2: Program Kerja === -->
            <div x-show="activeTab === 'proker'" style="display: none;" x-html="programsHtml"></div>

            <p x-show="!managementsHtml && !programsHtml" class="text-center text-gray-500">
                Struktur organisasi dan proker belum dipublikasi untuk periode ini.
            </p>
        </div>
    </div>
</section>

<script>
    function periodSwitcher({ initialPeriodId, initialManagementsHtml, initialProgramsHtml }) {
        return {
            activeTab: 'manajemen',
            selectedPeriodId: initialPeriodId,
            periodName: {{ Js::from($period?->name ?? 'Periode belum dipilih') }},
            managementsHtml: initialManagementsHtml,
            programsHtml: initialProgramsHtml,
            loading: false,
            isVisible: false,

            async loadPeriod() {
                if (!this.selectedPeriodId) return;

                this.loading = true;
                try {
                    const response = await fetch(`/api/struktur/${this.selectedPeriodId}`);
                    if (!response.ok) throw new Error('Gagal mengambil data periode');

                    const data = await response.json();
                    this.periodName = data.period_name;
                    this.managementsHtml = data.managements;
                    this.programsHtml = data.programs;
                } catch (error) {
                    console.error(error);
                    alert('Gagal memuat data periode. Coba lagi.');
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>