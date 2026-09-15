@extends('layouts.app')

@section('title', 'Home - Kayfa Dyah Wulandari')

@section('content')
<div class="flex flex-col items-center justify-center text-center py-20">
    <div class="space-y-6 max-w-2xl">
        <span class="text-blue-900 font-semibold uppercase tracking-wider text-sm">Selamat Datang</span>
        
        <h1 class="text-4xl sm:text-6xl font-extrabold text-blue-900 leading-tight">
            Kayfa Dyah Wulandari
        </h1>
        
        <p class="text-slate-700 text-lg leading-relaxed">
            Software Engineering Student.
        </p>
        
        <div class="flex justify-center items-center space-x-4 pt-4">
            <a href="{{ route('projects') }}" class="px-6 py-3 border border-blue-900 hover:bg-blue-900 text-slate-500 rounded-lg font-medium transition shadow-lg shadow-blue-500/20">
                Lihat Proyek
            </a>
            <a href="{{ route('about') }}" class="px-6 py-3 border border-slate-700 hover:bg-blue-900 text-slate-500 rounded-lg font-medium transition shadow-lg shadow-blue-500/20"">
                Tentang Saya
            </a>
        </div>
    </div>
</div>
@endsection