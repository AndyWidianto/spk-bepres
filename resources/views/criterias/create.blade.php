@extends('app')

@section('title', 'Tambah Kriteria - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="px-5 py-4 sm:px-6 sm:py-5">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Form Tambah Kriteria
        </h3>
    </div>

    <form method="POST" action="{{ route('criterias.store') }}">
        @csrf

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

            <!-- Elements -->
            <div>
                <label for="criteria_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama Kriteria
                </label>
                <input type="text" name="criteria_name" value="{{ old('criteria_name') }}" placeholder="IPK"
                    id="criteria_name" autocomplete="off" required
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                @if ($errors->has('criteria_name'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('criteria_name'))}}</p>
                @endif
            </div>

            <!-- Elements -->
            <div>
                <label for="weight" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Bobot
                </label>
                <input type="text" name="weight" id="weight" placeholder="0.01" required autocomplete="off"
                    value="{{ old('weight') }}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                @if ($errors->has('weight'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('weight'))}}</p>
                @endif
            </div>

            <!-- Elements -->
            <div>
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe</label>
                <select id="type" name="type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>- Pilih Tipe -</option>
                    <option value="benefit" {{ old('type')=='benefit' ? 'selected' : '' }}>Benefit</option>
                    <option value="cost" {{ old('type')=='cost' ? 'selected' : '' }}>Cost</option>
                </select>

                @if ($errors->has('type'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('type'))}}</p>
                @endif
            </div>

            <button type="submit"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan</button>

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