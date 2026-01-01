@extends('app')

@section('title', 'Daftar Status Kelulusan - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<ol class="flex items-center gap-1.5 mb-4 ml-1 mt-4">
    <li>
        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
            href="{{ url('/dashboard') }}">
            Home
            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>
    </li>
    <li class="text-sm text-gray-800 dark:text-white/90">Daftar Status Kelulusan</li>
</ol>

<div class="space-y-5 sm:space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">

                <p class="text-gray-700 inline text-xl dark:text-gray-300 font-bold">Daftar Status Kelulusan</p>
                </svg>

            </h3>

            <div class="mt-5">
                <button id="hitungwp"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Process Weighted Product
                </button>
            </div>

        </div>

        @if(session()->has('success'))
        <div class="flex justify-center mb-3 mt-3">
            <div class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50
                       dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="shrink-0 w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>

                <span class="font-medium text-center">
                    {{ session('success') }}
                </span>
            </div>
        </div>
        @endif
    </div>

        {{-- awal dari sini --}}
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-indigo-600 text-white p-3 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Sistem Pendukung Keputusan</h1>
                    <p class="text-gray-600">Penerimaan Beasiswa Prestasi - Metode Weighted Product</p>
                </div>
            </div>
            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded">
                <p class="text-sm text-gray-700">Sistem ini menampilkan proses perhitungan secara bertahap dan transparan agar dapat dipahami bagaimana hasil ranking diperoleh.</p>
            </div>
        </div>
        <div id="loading"></div>
        <div id="results"></div>
        {{-- akhir dari sini --}}
</div>
<script>
    const matrikS_string = localStorage.getItem('matrikS');
    const matrikV_string = localStorage.getItem('matrikV');
    const criteria_string = localStorage.getItem('criterias');
    const alternatives_string = localStorage.getItem('alternatives');
    const buttonhitung = document.getElementById('hitungwp');
    const resultsDiv = document.getElementById('results');
    const loading = document.getElementById("loading");
    buttonhitung.addEventListener('click', async function() { 
        loading.innerHTML = `<div class="fixed flex items-center justify-center w-full h-full left-0 top-0 z-99 bg-black/70">
                <div class="border-4 border-blue-600 border-t-transparent w-16 h-16 rounded-full animate-spin"></div>
        </div>`
        resultsDiv.innerHTML = '';
        await calculateWP();
        loading.innerHTML = '';
    });
    document.addEventListener('DOMContentLoaded', function() {
        if (criteria_string && alternatives_string) {
            const matrikS = JSON.parse(matrikS_string);
            const matrikV = JSON.parse(matrikV_string);
            const criteriasParsed = JSON.parse(criteria_string);
            const alternativesParsed = JSON.parse(alternatives_string);
            renderCalculationResults(matrikS, matrikV, null, criteriasParsed, alternativesParsed);
        }
    });
    async function calculateWP() {
        try {
            const response = await fetch("{{ route('calculations.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                }
            });
            if  (response.ok) {
                const data = await response.json();
                console.log('Success:', data);
                localStorage.setItem('criterias', JSON.stringify(data.criterias));
                localStorage.setItem('alternatives', JSON.stringify(data.alternatives));
                localStorage.setItem('matrikS', JSON.stringify(data.matrikS));
                localStorage.setItem('matrikV', JSON.stringify(data.matrikV));
                renderCalculationResults(data.matrikS, data.matrikV, data.ranked, data.criterias, data.alternatives);
            } else {
                console.error('Error:', response.statusText);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
    function renderCalculationResults(matrikS, matrikV, ranked, criterias, alternatives) {
        const totalMatrikS = matrikS.reduce((sum, item) => sum + item.score_s, 0);
        resultsDiv.innerHTML = `       
        <!-- Step 1: Normalisasi Bobot -->
        <div class="step-card bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-green-100 text-green-700 w-10 h-10 rounded-full flex items-center justify-center font-bold">1</div>
                <h2 class="text-2xl font-bold text-gray-800">Normalisasi Bobot Kriteria</h2>
            </div>
            
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-amber-900 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Rumus Normalisasi Bobot
                </h3>
                <p class="text-sm text-gray-700">W<sub>j</sub> = w<sub>j</sub> / Σw<sub>j</sub></p>
                <p class="text-xs text-gray-600 mt-1">Dimana: w<sub>j</sub> = bobot awal kriteria, W<sub>j</sub> = bobot ternormalisasi</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="border border-indigo-700 px-4 py-3 text-left">Kode</th>
                            <th class="border border-indigo-700 px-4 py-3 text-left">Nama Kriteria</th>
                            <th class="border border-indigo-700 px-4 py-3 text-center">Tipe</th>
                            <th class="border border-indigo-700 px-4 py-3 text-center">Bobot Awal (%)</th>
                            <th class="border border-indigo-700 px-4 py-3 text-center">Bobot Normalisasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        ${criterias.map(c => `
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-3 font-semibold">${c.code}</td>
                            <td class="border border-gray-300 px-4 py-3">${c.criteria_name}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold ${c.type === 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${c.type}</span>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-center">${c.weight * 100}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center font-mono">${c.weight}</td>
                        </tr>`).join('')}
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Step 2: Data Alternatif -->
        <div class="step-card bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-blue-100 text-blue-700 w-10 h-10 rounded-full flex items-center justify-center font-bold">2</div>
                <h2 class="text-2xl font-bold text-gray-800">Data Alternatif (Mahasiswa)</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="border border-indigo-700 px-4 py-3 text-left">NIM</th>
                            <th class="border border-indigo-700 px-4 py-3 text-left">Nama Mahasiswa</th>
                            ${criterias.map(c => `<th class="border border-indigo-700 px-4 py-3 text-center">${c.criteria_name}<br><span class="text-xs font-normal">(${c.code})</span></th>`).join('')}
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        ${alternatives.map(alt => `
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-3 font-mono">${alt.nim}</td>
                            <td class="border border-gray-300 px-4 py-3">${alt.name}</td>
                            ${criterias.map(c => {
                                const scoreObj = alt.scores.find(s => s.criteria_id === c.criteria_id);
                                const scoreValue = scoreObj ? scoreObj.score : '-';
                                return `<td class="border border-gray-300 px-4 py-3 text-center font-mono">${scoreValue}</td>`;
                            }).join('')}
                        </tr>`).join('')}
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Step 3: Matriks S -->
        <div class="step-card bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-purple-100 text-purple-700 w-10 h-10 rounded-full flex items-center justify-center font-bold">3</div>
                <h2 class="text-2xl font-bold text-gray-800">Perhitungan Matriks S (Vektor S)</h2>
            </div>
            
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-amber-900 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Rumus Matriks S
                </h3>
                <p class="text-sm text-gray-700">S<sub>i</sub> = ∏(X<sub>ij</sub>)<sup>W<sub>j</sub></sup></p>
                <p class="text-xs text-gray-600 mt-1">Untuk kriteria <strong>Benefit</strong>: pangkat positif (+W<sub>j</sub>), untuk <strong>Cost</strong>: pangkat negatif (-W<sub>j</sub>)</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="border border-indigo-700 px-4 py-3 text-left">Nama Mahasiswa</th>
                            <th class="border border-indigo-700 px-4 py-3 text-center">Nilai S</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        ${matrikS.map(item => `
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-3">${item.name}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center font-mono font-bold text-indigo-600">${item.score_s.toFixed(6)}</td>
                        </tr>`).join('')}
                        <tr class="bg-gray-100 font-bold">
                            <td class="border border-gray-300 px-4 py-3 text-right">Total (ΣS)</td>
                            <td class="border border-gray-300 px-4 py-3 text-center font-mono">${totalMatrikS.toFixed(6)}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Step 4: Matriks V -->
        <div class="step-card bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-orange-100 text-orange-700 w-10 h-10 rounded-full flex items-center justify-center font-bold">4</div>
                <h2 class="text-2xl font-bold text-gray-800">Perhitungan Matriks V (Nilai Preferensi)</h2>
            </div>
            
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-amber-900 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Rumus Matriks V
                </h3>
                <p class="text-sm text-gray-700">V<sub>i</sub> = S<sub>i</sub> / ΣS<sub>i</sub></p>
                <p class="text-xs text-gray-600 mt-1">Nilai preferensi diperoleh dengan membagi nilai S setiap alternatif dengan total S</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="border border-indigo-700 px-4 py-3 text-left">Nama Mahasiswa</th>
                            <th class="border border-indigo-700 px-4 py-3 text-center">Nilai S</th>
                            <th class="border border-indigo-700 px-4 py-3 text-center">Perhitungan</th>
                            <th class="border border-indigo-700 px-4 py-3 text-center">Nilai V</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        ${matrikV.map(item => `
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-3">${item.name}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center font-mono font-bold text-indigo-600">${item.score_s.toFixed(6)}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center text-sm">${item.score_s.toFixed(6)} / ${totalMatrikS.toFixed(6)}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center font-mono font-bold text-green-600">${item.score_v.toFixed(6)}</td>
                        </tr>`).join('')}
                    </tbody>
                </table>
            </div>
        </div>`
    }
</script>

@endsection