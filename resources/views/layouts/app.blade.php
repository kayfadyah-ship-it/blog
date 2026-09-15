<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portofolio Web')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 font-sans antialiased min-h-screen flex flex-col justify-between">
    
    <div>
        @include('partials.navbar')

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @yield('content')
        </main>
    </div>

    <footer class="border-t border-slate-800 py-6 text-center text-sm text-slate-500">
        <p>&copy; {{ date('Y') }} Kayfa Dyah Wulandari. All rights reserved.</p>
    </footer>

</body>
</html>