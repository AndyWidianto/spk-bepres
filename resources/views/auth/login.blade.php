<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    @vite([
    'resources/css/app.css',
    'resources/css/tailadmin/style.css',
    'resources/js/app.js',
    'resources/js/tailadmin/index.js'
    ])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body>

    @if($success = Session::get('success'))
    <script>
        Swal.fire({
        title: "Berhasil",
        text: "{{ $success }}",
        icon: "success"
    });
    </script>
    @endif

    <div class="mt-10">
        <h1 class="text-center mb-10 text-2xl">Login</h1>
        <form method="post" class="max-w-sm mx-auto" action="{{ url('/login-process') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan
                    email</label>
                <input type="email" id="email" name="email" autocomplete="off" value="{{ old('email') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />

                @if ($errors->has('email'))
                <p class="mt-3" style="font-size: 15px; color:red;"><i class="bi bi-exclamation-octagon-fill"></i>
                    {{ucfirst($errors->first('email'))}}
                </p>
                @endif
            </div>

            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan
                    password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />

                @if ($errors->has('password'))
                <p class="mt-3" style="font-size: 15px; color:red;"><i class="bi bi-exclamation-octagon-fill"></i>
                    {{ucfirst($errors->first('password'))}}
                </p>
                @endif
            </div>

            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="remember" name="remember" @if(old('remember')) checked @endif type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                    me</label>
            </div>
            <button type="submit"
                class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
        </form>
    </div>

</body>

</html>