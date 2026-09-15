@extends('layouts.app')

@section('title', 'About - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-8">
    <div class="border-b border-slate-800 pb-4">
        <h1 class="text-3xl font-bold text-slate-800">Tentang Saya</h1>
    </div>

    <div class="prose prose-invert text-slate-800 leading-relaxed max-w-none">
        <p>
            Saya adalah mahasiswa <strong>Teknologi Rekayasa Perangkat Lunak</strong> <strong>Universitas Gadjah Mada</strong>. Memiliki ketertarikan pada pengembangan perangkat lunak, (UI/UX), serta manajemen proyek berbasis teknologi.
        </p>
    </div>

    <div class="space-y-4 pt-4">
        <h2 class="text-xl font-bold text-slate-800">Keahlian (Tech Stack)</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @php
                $skills = ['PHP & Laravel', 'Java & Kotlin', 'Python', 'SQL / Oracle', 'Git & GitHub', 'Android Studio', 'Figma', 'VS Code'];
            @endphp
            @foreach($skills as $skill)
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-800/40 flex items-center space-x-3">
                    <span class="w-2 h-2 rounded-full bg-blue-900"></span>
                    <span class="font-medium text-slate-800 text-sm">{{ $skill }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection