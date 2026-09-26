@extends('layouts.app')

@section('title', 'About - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-8 my-auto max-w-5xl">
    <h1 class="text-4xl sm:text-5xl font-bold text-black">Tentang saya</h1>

    <p class="text-slate-900 text-lg sm:text-xl font-normal leading-relaxed max-w-4xl">
        Saya adalah mahasiswa Teknologi Rekayasa Perangkat Lunak Universitas Gadjah Mada. Memiliki ketertarikan pada pengembangan perangkat lunak, (UI/UX), serta manajemen proyek berbasis teknologi.
    </p>

    <div class="space-y-4 pt-4">
        <h2 class="text-2xl font-bold text-black">Keahlian</h2>
        
        <div class="flex flex-wrap gap-4">
            @php
                $skills = ['PHP & Laravel', 'Java & Kotlin', 'Python', 'SQL / Oracle', 'Git & GitHub'];
            @endphp
            @foreach($skills as $skill)
                <div class="px-6 py-2.5 rounded-xl border border-black bg-white">
                    <span class="font-bold text-[#040084] text-sm">{{ $skill }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection