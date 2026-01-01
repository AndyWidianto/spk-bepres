@extends('app')

@section('title', 'Dashboard - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<ol class="flex items-center gap-1.5 mb-4 ml-1 mt-4">
    <li class="text-sm text-gray-800 dark:text-white/90">Dashboard</li>
</ol>

    <!-- Main Content -->
    <div class="min-h-screen">
        <!-- Main Content Area -->
        <main class="p-6">
            <!-- Header Dashboard -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
                <p class="text-gray-600">Sistem Pendukung Keputusan (SPK) menggunakan metode Weighted Product (WP) untuk seleksi penerima beasiswa prestasi.</p>
            </div>

            <!-- Statistik Cards -->
            <div class="grid sm:grid-cols-1 lg:grid-cols-4 md:grid-cols-2 gap-6 mb-10">
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Mahasiswa</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalAlternatives }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-green-600 text-sm mt-3 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i> 12% dari periode lalu
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Kriteria</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $criterias->count() }}</p>
                        </div>
                        <div class="bg-indigo-100 p-3 rounded-lg">
                            <i class="fas fa-list-alt text-indigo-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mt-3 font-medium">
                        @foreach ($criterias as $criteria)
                            {{ $criteria->criteria_name }}@if (!$loop->last), @endif
                        @endforeach
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Lolos Seleksi</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $alternatives->count() }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-green-600 text-sm mt-3 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i> {{ $alternatives->count() > 0 ? ($alternatives->count() / $totalAlternatives * 100) : 0 }}% dari total peserta
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Tahun Akademik</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ date('Y') }}/{{ date('Y', strtotime('+1 year')) }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mt-3 font-medium">
                        @php
                            $bulan = date('n');
                            $semester = ($bulan >= 7) ? 'Ganjil' : 'Genap';
                        @endphp

                        Semester {{ $semester }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Tabel Data Mahasiswa -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800">Data Mahasiswa</h2>
                            <p class="text-gray-600 text-sm">Daftar mahasiswa yang mengajukan beasiswa prestasi</p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        @foreach ($criterias as $criteria)
                                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $criteria->criteria_name }}</th>
                                        @endforeach
                                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($alternatives as $alternative)
                                        <tr>
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $alternative->nim }}</td>
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $alternative->name }}</td>
                                            @foreach ($criterias as $criteria)
                                                @php
                                                    $score = $alternative->scores->firstWhere('criteria_id', $criteria->criteria_id);
                                                @endphp
                                                <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $score ? $score->score : 'N/A' }}
                                                </td>
                                            @endforeach
                                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800 font-bold">
                                                {{ $loop->iteration }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-4 border-t border-gray-200 text-center">
                            <a href="{{ route('students.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Lihat semua data →</a>
                        </div>
                    </div>
                </div>

                <!-- Section Hasil SPK -->
                <div>
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden h-full">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800">Top 5 Penerima Beasiswa</h2>
                            <p class="text-gray-600 text-sm">Perankingan berdasarkan nilai WP tertinggi</p>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Mahasiswa 1 -->
                                @foreach ($alternatives->take(5) as $index => $alternative)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="badge-ranking  text-black mr-4">
                                            {{ $loop->iteration }}
                                            {{ $loop->iteration == 1 ? '🏆' : ($loop->iteration == 2 ? '🥈' : ($loop->iteration == 3 ? '🥉' : '⭐')) }}
                                        </span>
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $alternative->name }}</h4>
                                            <p class="text-gray-600 text-sm">NIM: {{ $alternative->nim }} | Nilai WP: {{ number_format($alternative->final_score, 3) }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Lolos</span>
                                </div>
                                @endforeach
                            </div>

                            <!-- Progress Bar Section -->
                            <div class="mt-10 pt-6 border-t border-gray-200">
                                <h3 class="font-bold text-gray-800 mb-4">Status Seleksi</h3>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">Lolos Seleksi</span>
                                            <span class="text-sm font-medium text-gray-700">{{ $alternatives->count() > 0 ? ($alternatives->count() / $totalAlternatives) * 100 : 0 }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-600 h-2.5 rounded-full progress-bar" style="width: {{$alternatives->count() > 0 ? ($alternatives->count() / $totalAlternatives) * 100 : 0}}"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">Tidak Lolos</span>
                                            <span class="text-sm font-medium text-gray-700">{{ $alternatives->count() > 0 ? (1 - ($alternatives->count() / $totalAlternatives)) * 100 : 0 }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-red-600 h-2.5 rounded-full progress-bar" style="width: {{ $alternatives->count() > 0 ? (1 - ($alternatives->count() / $totalAlternatives)) * 100 : 0 }}"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex space-x-4">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-green-600 mr-2"></div>
                                        <span class="text-sm text-gray-700">Lolos ({{ $alternatives->count() }} mahasiswa)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-red-600 mr-2"></div>
                                        <span class="text-sm text-gray-700">Tidak Lolos ({{ $totalAlternatives - $alternatives->count() }} mahasiswa)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{-- <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-6 px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-600 text-sm mb-4 md:mb-0">
                    <p>Copyright © <span class="font-medium">Sistem SPK Beasiswa Prestasi</span> - 2023/2024</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-500 hover:text-indigo-600 text-sm">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-500 hover:text-indigo-600 text-sm">Syarat & Ketentuan</a>
                    <a href="#" class="text-gray-500 hover:text-indigo-600 text-sm">Bantuan</a>
                </div>
            </div>
        </footer> --}}
    </div>

@endsection