<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Task List App</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="container mx-auto my-10 max-w-lg">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">@yield('title')</h1>
    <div x-data="{ flash: true }">
        @if (session()->has('success'))
            <div x-show="flash"
                class="relative mb-5 rounded border px-4 py-3 text-lg border-green-400 bg-green-100 text-green-700"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <p>{{ session('success') }}</p>
                <span class="absolute top-0 right-0 px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        @click="flash = false" stroke="currentColor" class="h-6 w-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
        @endif

        @yield('content')
    </div>
</body>

</html>
