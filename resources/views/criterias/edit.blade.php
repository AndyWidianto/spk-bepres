@extends('app')

@section('title', 'Edit Kriteria - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="px-5 py-4 sm:px-6 sm:py-5">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Form Edit Kriteria
        </h3>
    </div>

    <form method="POST" action="{{ route('criterias.update', $criteria->criteria_id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

            <!-- Elements -->
            <div>
                <label for="criteria_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Code Kriteria
                </label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="C1"
                    id="code" autocomplete="off" required
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                @if ($errors->has('code'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('code'))}}</p>
                @endif
            </div>

            <!-- Nama Kriteria -->
            <div>
                <label for="criteria_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama Kriteria
                </label>
                <input type="text" name="criteria_name" id="criteria_name" required autocomplete="off"
                    value="{{ old('criteria_name', $criteria->criteria_name) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10
                           dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300
                           bg-transparent px-4 py-2.5 text-sm text-gray-800
                           focus:ring-3 focus:outline-hidden dark:border-gray-700
                           dark:bg-gray-900 dark:text-white/90">

                @error('criteria_name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ ucfirst($message) }}
                </p>
                @enderror
            </div>

            <!-- Bobot -->
            <div>
                <label for="weight" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Bobot
                </label>
                <input type="number" step="0.01" name="weight" id="weight" required autocomplete="off"
                    value="{{ old('weight', $criteria->weight) }}" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10
                           dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300
                           bg-transparent px-4 py-2.5 text-sm text-gray-800
                           focus:ring-3 focus:outline-hidden dark:border-gray-700
                           dark:bg-gray-900 dark:text-white/90">

                @error('weight')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ ucfirst($message) }}
                </p>
                @enderror
            </div>

            <!-- Tipe -->
            <div>
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Tipe
                </label>
                <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">- Pilih Tipe -</option>
                    <option value="benefit" {{ old('type', $criteria->type) == 'benefit' ? 'selected' : '' }}>
                        Benefit
                    </option>
                    <option value="cost" {{ old('type', $criteria->type) == 'cost' ? 'selected' : '' }}>
                        Cost
                    </option>
                </select>

                @error('type')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ ucfirst($message) }}
                </p>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500
            focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg
            text-sm px-5 py-2.5 me-2 dark:focus:ring-yellow-900">
                Update
            </button>

            <a href="{{ route('criterias.index') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800
                      focus:ring-4 focus:ring-red-300 font-medium rounded-lg
                      text-sm px-5 py-2.5 me-2
                      dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Kembali
            </a>

        </div>
    </form>
</div>

@endsection