@extends('layouts.app')

@section('title', 'Education - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-8 my-auto w-full">
    <!-- Judul Halaman Utama -->
    <h1 class="text-4xl sm:text-5xl font-bold text-black text-center mb-8">Education</h1>

    <div class="space-y-6 w-full">
        <div class="p-6 rounded-2xl border border-black bg-white space-y-1 w-full">
            <h3 class="text-base font-medium text-[#040084]">Pendidikan</h3>
            <h2 class="text-2xl sm:text-3xl font-bold text-black pt-1">Universitas Gadjah Mada</h2>
            <p class="text-slate-800 text-sm font-normal">Sarjana Terapan - Teknologi Rekayasa Perangkat Lunak (TRPL)</p>
            <p class="text-xs text-slate-800 pt-3">Aktif • Angkatan 2025</p>
        </div>

        <div class="p-6 rounded-2xl border border-black bg-white space-y-3 w-full">
            <h3 class="text-base font-medium text-[#040084]">Pengalaman & Kepanitiaan</h3>

            <ul class="space-y-1.5 text-black text-sm list-disc list-inside font-normal">
                <li><span class="font-bold">Ketua Divisi Redaksi 2025</span> - Journalistic Organization of Bonlap</li>
                <li><span class="font-bold">Bendahara</span> - Gamabon 25</li>
                <li><span class="font-bold">Staff Sponsorship</span> - Liga TRPL 2025</li>
                <li><span class="font-bold">Staff Keamanan</span> - TGES 2025</li>
            </ul>
        </div>
    </div>
</div>
@endsection