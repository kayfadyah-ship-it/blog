<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portofolio Web')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: #f8fafc !important; /* Background abu-abu sangat muda biar gak silau */
            color: #1e293b !important;
        }

        h2, h3, .navbar-brand {
            font-weight: 700 !important;
            color: #0f172a !important;
        }

        .form-control {
            border-color: #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 0.6rem 0.9rem !important;
        }
        .form-control:focus {
            border-color: #4f46e5 !important; /* Warna aksen fokus saat diklik */
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15) !important;
        }

        .btn-primary {
            background-color: #4f46e5 !important;
            border-color: #4f46e5 !important;
            border-radius: 8px !important;
            padding: 0.5rem 1.25rem !important;
            font-weight: 600 !important;
        }
        .btn-primary:hover {
            background-color: #4338ca !important;
            border-color: #4338ca !important;
        }

        .btn-secondary {
            background-color: #e2e8f0 !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
            border-radius: 8px !important;
            padding: 0.5rem 1.25rem !important;
            font-weight: 600 !important;
        }
        .btn-secondary:hover {
            background-color: #cbd5e1 !important;
            color: #1e293b !important;
        }
    </style>

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