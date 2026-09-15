@extends('layouts.app')

@section('title', 'Education - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-8">
    <div class="border-b border-slate-800 pb-4">
        <h1 class="text-3xl font-bold text-slate-800">Riwayat Pendidikan & Organisasi</h1>
        <p class="text-slate-800 text-sm mt-1">Latar belakang akademis dan pengalaman kepanitiaan.</p>
    </div>

    <div class="space-y-6">
        <div class="p-6 rounded-xl border border-slate-200 bg-slate-800/30">
            <span class="text-xs font-semibold text-blue-900 uppercase tracking-wider">Pendidikan Utama</span>
            <h2 class="text-xl font-bold text-slate-800 mt-1">Universitas Gadjah Mada (UGM)</h2>
            <p class="text-slate-600 text-sm">Sarjana Terapan - Teknologi Rekayasa Perangkat Lunak (TRPL)</p>
            <p class="text-xs text-slate-500 mt-2">Aktif • Angkatan 2025</p>
        </div>

        {{-- Kepanitiaan & Pengalaman --}}
        <div class="p-6 rounded-xl border border-slate-200 bg-slate-800/30 space-y-4">
            <span class="text-xs font-semibold text-blue-900 uppercase tracking-wider">Pengalaman & Kepanitiaan</span>

            <ul class="space-y-3 text-slate-600 text-sm">
                <li class="flex items-start space-x-2">
                    <span class="text-blue-900">&bull;</span>
                    <div>
                        <strong>Sponsorship</strong> — LIGA TRPL 2025
                    </div>
                </li>
                <li class="flex items-start space-x-2">
                    <span class="text-blue-900">&bull;</span>
                    <div>
                        <strong>Bendahara</strong> — Gamabon 25
                    </div>
                </li>
                <li class="flex items-start space-x-2">
                    <span class="text-blue-900">&bull;</span>
                    <div>
                        <strong>Keamanan Acara</strong> — TGES 2025
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection