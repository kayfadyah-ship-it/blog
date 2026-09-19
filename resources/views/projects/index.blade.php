@extends('layouts.app')

@section('title', 'Projects - Kayfa Dyah Wulandari')

@section('content')
    <div class="space-y-8">
        <div class="border-b border-slate-800 pb-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Proyek Portofolio</h1>
                <p class="text-slate-600 text-sm mt-1">Daftar proyek dan aplikasi yang pernah saya kerjakan.</p>
            </div>

            <a href="{{ route('projects.create') }}"
                class="px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white font-medium text-sm rounded-lg transition shadow">
                + Tambah Projek Baru
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($projects as $project)
                <div
                    class="p-6 rounded-xl border border-slate-200 bg-slate-800/30 flex flex-col justify-between space-y-4 shadow-sm">
                    <div class="space-y-2">
                        <span
                            class="text-xs font-semibold text-blue-900 bg-blue-500/10 px-2.5 py-1 rounded border border-blue-500/20">
                            {{ $project->category ?? 'Web Application' }}
                        </span>
                        <h2 class="text-xl font-bold text-slate-800">{{ $project->title }}</h2>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            {{ $project->description }}
                        </p>
                    </div>

                    <div class="space-y-3 pt-2">
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="text-xs font-semibold text-blue-900 bg-blue-500/10 px-2.5 py-1 rounded border border-blue-500/20">
                                {{ $project->category ?? 'Web Application' }}
                            </span>
            
                            <span class="text-xs bg-slate-800 text-slate-300 px-2.5 py-1 rounded">
                                {{ $project->technology ?? 'Laravel' }}
                            </span>
                        </div>

                        <div class="pt-2 border-t border-slate-200/50 flex justify-between items-center">
                            <a href="{{ route('projects.show', $project->id) }}"
                                class="text-xs font-semibold text-blue-600 hover:underline">
                                Lihat Detail &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-10">
                    <p class="text-slate-500 font-medium">Belum ada data projek.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection