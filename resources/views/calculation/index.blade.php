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

            <form class="mt-5" action="{{ route('calculations.store') }}" method="POST">
                @csrf
                <button type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Process Weighted Product
                </button>
            </form>

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

        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

            <div
                class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="max-w-full overflow-x-auto pt-10 pl-5 pr-5 pb-5">

                    <table id="search-table">

                        <thead>
                            <tr>
                                <th>
                                    <span class="flex items-center">
                                        No
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Nama
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        IPK
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Penghasilan Orang Tua
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Prestasi
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Status
                                    </span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($results as $item)
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                                    $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->gpa }}</td>
                                <td> Rp {{ number_format($item->income_parents, 0, ',', '.') }}</td>
                                <td>{{ $item->achievement }}</td>
                                <td>{{ $item->status == '' ? '-' : $item->status }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection