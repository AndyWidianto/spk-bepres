@extends('app')

@section('title', 'Tambah Mahasiswa - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="px-5 py-4 sm:px-6 sm:py-5">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Form Tambah Mahasiswa
        </h3>
    </div>

    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">


            <!-- Elements -->
            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama Mahasiswa
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="off" required
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                @if ($errors->has('name'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('name'))}}</p>
                @endif
            </div>

            <!-- Elements -->
            <div>
                <label for="gpa" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    IPK
                </label>
                <input type="text" name="gpa" id="gpa" value="{{ old('gpa') }}" required autocomplete="off"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                @if ($errors->has('gpa'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('gpa'))}}</p>
                @endif
            </div>

            <!-- Elements -->
            <div>
                <label for="income_parents" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Penghasilan Orang Tua
                </label>
                <input type="number" name="income_parents" value="{{ old('income_parents') }}" id="income_parents"
                    required
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                @if ($errors->has('income_parents'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('income_parents'))}}</p>
                @endif
            </div>

            <!-- Elements -->
            <div>
                <label for="achievement" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Prestasi
                </label>
                <input type="number" name="achievement" value="{{ old('achievement') }}" id="achievement" required
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                @if ($errors->has('achievement'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ucfirst($errors->first('achievement'))}}</p>
                @endif
            </div>

            <button type="submit"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan</button>

            <a href="{{ route('students.index') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800
                focus:ring-4 focus:ring-red-300 font-medium rounded-lg
                text-sm px-5 py-2.5 me-2 
                dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                Kembali
            </a>
        </div>
    </form>
</div>

@endsection