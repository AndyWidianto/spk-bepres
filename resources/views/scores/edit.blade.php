@extends('app')

@section('title', 'Edit Skor - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="px-5 py-4 sm:px-6 sm:py-5">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Form Edit Skor
        </h3>
    </div>


    <form method="POST" action="{{ route('scores.update', $score->score_id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

            <!-- Skor -->
            <div>
                <label for="score" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Skor
                </label>
                <input type="text" name="score" id="score" required autocomplete="off"
                    value="{{ old('score', $score->score) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10
                    dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent
                    px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3
                    focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                @error('score')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alternatif -->
            <div>
                <label for="alternative_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Mahasiswa
                </label>
                <select id="alternative_id" name="alternative_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                    <option value="">- Pilih Mahasiswa -</option>
                    @foreach ($alternatives as $alt)
                    <option value="{{ $alt->alternative_id }}" {{ old('alternative_id', $score->alternative_id) ==
                        $alt->alternative_id ? 'selected' : '' }}>
                        {{ $alt->name }}
                    </option>
                    @endforeach
                </select>

                @error('alternative_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kriteria -->
            <div>
                <label for="criteria_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Kriteria
                </label>
                <select id="criteria_id" name="criteria_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                    <option value="">- Pilih Kriteria -</option>
                    @foreach ($criterias as $c)
                    <option value="{{ $c->criteria_id }}" {{ old('criteria_id', $score->criteria_id) == $c->criteria_id
                        ? 'selected' : '' }}>
                        {{ $c->criteria_name }}
                    </option>
                    @endforeach
                </select>

                @error('criteria_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action -->
            <button type="submit" class="focus:outline-none text-white bg-yellow-500 hover:bg-yellow-600
                focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm
                px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700">
                Update
            </button>

            <a href="{{ route('scores.index') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800
                focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm
                px-5 py-2.5 me-2 dark:bg-red-600 dark:hover:bg-red-700">
                Kembali
            </a>
        </div>
    </form>


</div>

@endsection