@extends('app')

@section('title', 'Dashboard - ' . str_replace('_', ' ', env('APP_NAME')))

@section('content')

<ol class="flex items-center gap-1.5 mb-4 ml-1 mt-4">
    <li class="text-sm text-gray-800 dark:text-white/90">Dashboard</li>
</ol>

<div class="mt-5 mx-auto mb-5">
    <div
        class=" p-6 mr-5 mb-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

        <svg class="w-12 h-12 text-gray-800 dark:text-white mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                clip-rule="evenodd" />
        </svg>

        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Selamat datang Admin!</h5>

        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Kelola dan seleksi beasiswa prestasi menggunakan
            sistem SPK.</p>
    </div>

    {{-- <div
        class="max-w-sm p-6 mr-5 mb-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

        <svg class="w-12 h-12 text-gray-800 mb-3 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                clip-rule="evenodd" />
        </svg>

        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Total Mahasiswa Lolos</h5>

        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-2xl">{{ $countPassed }}</p>
    </div>

    <div
        class="max-w-sm p-6 mb-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

        <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z"
                clip-rule="evenodd" />
        </svg>

        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Total Mahasiswa Tidak Lolos
        </h5>

        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-2xl">{{ $countNotPassed }}</p>
    </div> --}}
</div>

<div class="space-y-5 sm:space-y-6">

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5">

            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">

                <p class="text-gray-700 inline text-xl dark:text-gray-300 font-bold">Daftar Status Kelulusan</p>
                </svg>

            </h3>
        </div>

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
                                        Status
                                    </span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($resultStudents as $item)
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                                    $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
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