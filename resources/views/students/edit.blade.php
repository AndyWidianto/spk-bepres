@extends('app')

@section('title', 'Edit Mahasiswa - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="px-5 py-4 sm:px-6 sm:py-5">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Form Edit Mahasiswa
        </h3>
    </div>

    <form method="POST" action="{{ route('students.update', $student->alternative_id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

            <!-- Nama -->
            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama Mahasiswa
                </label>
                <input type="text" name="name" id="name" autocomplete="off" required
                    value="{{ old('name', $student->name) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ ucfirst($message) }}</p>
                @enderror
            </div>

            <!-- IPK -->
            <div>
                <label for="gpa" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    IPK
                </label>
                <input type="number" step="0.01" name="gpa" id="gpa" required value="{{ old('gpa', $student->gpa) }}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('gpa')
                <p class="mt-2 text-sm text-red-600">{{ ucfirst($message) }}</p>
                @enderror
            </div>

            <!-- Penghasilan Orang Tua -->
            <div>
                <label for="income_parents" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Penghasilan Orang Tua
                </label>
                <input type="number" name="income_parents" id="income_parents" required
                    value="{{ old('income_parents', $student->income_parents) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('income_parents')
                <p class="mt-2 text-sm text-red-600">{{ ucfirst($message) }}</p>
                @enderror
            </div>

            <!-- Prestasi -->
            <div>
                <label for="achievement" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Prestasi
                </label>
                <input type="number" name="achievement" id="achievement" required
                    value="{{ old('achievement', $student->achievement) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('achievement')
                <p class="mt-2 text-sm text-red-600">{{ ucfirst($message) }}</p>
                @enderror
            </div>

            <!-- Button -->
            <div class="flex gap-2">
                <button type="submit" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500
                focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg
                text-sm px-5 py-2.5 me-2 dark:focus:ring-yellow-900">
                    Update
                </button>

                <a href="{{ route('students.index') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800
                focus:ring-4 focus:ring-red-300 font-medium rounded-lg
                text-sm px-5 py-2.5 me-2 
                dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Kembali
                </a>
            </div>

        </div>
    </form>

</div>

@endsection