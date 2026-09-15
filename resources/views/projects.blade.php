@extends('layouts.app')

@section('title', 'Projects - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-8">
    <div class="border-b border-slate-800 pb-4">
        <h1 class="text-3xl font-bold text-slate-800">Proyek Portofolio</h1>
        <p class="text-slate-600 text-sm mt-1">Daftar proyek dan aplikasi yang pernah saya kerjakan.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        {{-- Proyek 1 --}}
        <div class="p-6 rounded-xl border border-slate-200 bg-slate-800/30 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-blue-900 bg-blue-500/10 px-2.5 py-1 rounded border border-blue-500/20">Web Application</span>
                <h2 class="text-xl font-bold text-slate-800">Si Pengembang Diri DTEDI</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Sistem berbasis web untuk DTEDI. Berperan sebagai <strong>Project Manager</strong> .
                </p>
            </div>
            <div class="flex flex-wrap gap-2 pt-2">
                <span class="text-xs bg-slate-800 text-slate-300 px-2.5 py-1 rounded">Project Management</span>
            </div>
        </div>

        {{-- Proyek 2 --}}
        <div class="p-6 rounded-xl border border-slate-200 bg-slate-800/30 flex flex-col justify-between space-y-4">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-blue-900 bg-blue-500/10 px-2.5 py-1 rounded border border-blue-500/20">Game Development</span>
                <h2 class="text-xl font-bold text-slate-800">Java Desktop Game Project</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Pengembangan game berbasis Java OOP.
                </p>
            </div>
            <div class="flex flex-wrap gap-2 pt-2">
                <span class="text-xs bg-slate-800 text-slate-300 px-2.5 py-1 rounded">Java</span>
            </div>
        </div>
    </div>
</div>
@endsection