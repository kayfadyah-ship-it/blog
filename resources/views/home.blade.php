@extends('layouts.app')

@section('title', 'Home - Kayfa Dyah Wulandari')

@section('content')
    <div class="flex flex-col items-center justify-center text-center my-auto py-12">
        <div class="space-y-3 max-w-xl">
            <p class="text-2xl sm:text-3xl font-normal text-black tracking-tight">
                Selamat Datang
            </p>

            <h1 class="text-3xl sm:text-4xl font-bold text-black tracking-tight">
                Kayfa Dyah Wulandari
            </h1>

            <!-- Subtitle -->
            <p class="text-slate-600 text-sm sm:text-base font-normal pt-1">
                Software Engineering Student.
            </p>

            <div class="flex justify-center items-center gap-4 pt-4">
                <a href="{{ route('about') }}"
                    class="px-6 py-2.5 rounded-xl border border-black bg-white text-[#040084] font-semibold text-sm hover:bg-black hover:text-white transition-colors duration-200">
                    Tentang Saya
                </a>

                <a href="{{ route('projects.index') }}"
                    class="px-6 py-2.5 rounded-xl border border-black bg-white text-[#040084] font-semibold text-sm hover:bg-black hover:text-white transition-colors duration-200">
                    Lihat Projek
                </a>
            </div>
        </div>
    </div>
@endsection