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

            <div class="flex justify-center items-center gap-4">
                <a href="{{ route('projects.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-200 bg-white shadow-sm text-blue-600 hover:bg-blue-600 hover:text-white transition-colors font-medium">
                    Lihat Proyek
                </a>

                <a href="{{ route('about') }}"
                    class="px-6 py-3 rounded-xl border border-slate-200 bg-white shadow-sm text-blue-600 hover:bg-blue-600 hover:text-white transition-colors font-medium">
                    Tentang Saya
                </a>
            </div>
        </div>
    </div>
@endsection