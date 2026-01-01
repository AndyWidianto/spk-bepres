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
            <!-- Nim -->
            <div>
                <label for="nim" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nim Mahasiswa
                </label>
                <input type="text" name="nim" id="nim" autocomplete="off" required
                    value="{{ old('nim', $student->nim) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ ucfirst($message) }}</p>
                @enderror
            </div>

            <!-- Program Studi -->
            <div>
                <label for="program_study" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Program Studi
                </label>
                <input type="text" name="program_study" id="program_study" autocomplete="off" required
                    value="{{ old('program_study', $student->program_study) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ ucfirst($message) }}</p>
                @enderror
            </div>

            <!-- Fakultas -->
            <div>
                <label for="faculty" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Fakultas
                </label>
                <input type="text" name="faculty" id="faculty" autocomplete="off" required
                    value="{{ old('faculty', $student->faculty) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ ucfirst($message) }}</p>
                @enderror
            </div>
            <!-- Universitas -->
            <div>
                <label for="university" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Universitas
                </label>
                <input type="text" name="university" id="university" autocomplete="off" required
                    value="{{ old('university', $student->university) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300
                           focus:ring-brand-500/10 h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5
                           text-sm text-gray-800 focus:ring-3 focus:outline-hidden
                           dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('university')
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