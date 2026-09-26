<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kayfa Dyah')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-slate-900 min-h-screen flex flex-col justify-between antialiased">

    @include('partials.navbar')

    <main class="flex-1 flex flex-col w-full max-w-7xl mx-auto px-6 sm:px-12 py-10">
        @yield('content')
    </main>

    <footer class="w-full border-t border-black py-4 text-center text-sm font-normal text-slate-900">
        <p>© {{ date('Y') }} Kayfa Dyah Wulandari. All rights reserved.</p>
    </footer>

</body>
</html>