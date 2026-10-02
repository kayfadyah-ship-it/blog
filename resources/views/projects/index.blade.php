@extends('layouts.app')

@section('title', 'Projects - Kayfa Dyah Wulandari')

@section('content')
    <div class="space-y-6 my-auto w-full">

        @if(session('success'))
            <div
                class="p-4 rounded-xl border border-black bg-[#040084]/10 text-[#040084] font-medium text-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()"
                    class="text-[#040084] font-bold text-lg hover:text-black">&times;</button>
            </div>
        @endif

        <div class="flex justify-between items-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-black">Projects</h1>

            <div class="flex items-center gap-3">
                <a href="{{ route('projects.create') }}"
                    class="px-5 py-2.5 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition shadow">
                    Tambah Proyek Baru
                </a>

                <a href="{{ route('projects.trash') }}"
                    class="px-5 py-2.5 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition shadow">
                    Trash
                </a>

            </div>


        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($projects as $project)
                <div class="p-6 rounded-2xl border border-black bg-white flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <span class="text-base font-normal text-[#040084]">
                            {{ $project->category ?? 'Web Application' }}
                        </span>
                        <h2 class="text-2xl font-bold text-black">{{ $project->title }}</h2>
                        <p class="text-slate-800 text-sm font-normal leading-relaxed">
                            {{ $project->description }}
                        </p>
                    </div>

                    <div class="flex justify-between items-end pt-4">
                        <span class="text-xs font-semibold text-white bg-[#040084] px-3 py-1.5 rounded-full">
                            {{ $project->technology ?? 'Laravel' }}
                        </span>

                        <a href="{{ route('projects.show', $project->id) }}"
                            class="text-xs font-normal text-black hover:underline">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-10 border border-dashed border-slate-300 rounded-xl">
                    <p class="text-slate-500 font-medium">Belum ada data projek.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection