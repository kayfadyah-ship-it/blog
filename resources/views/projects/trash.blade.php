@extends('layouts.app')

@section('title', 'Trash Projects - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-6 my-auto w-full">

    {{-- Alert Notification --}}
    @if(session('success'))
        <div class="p-4 rounded-xl border border-black bg-[#040084]/10 text-[#040084] font-medium text-sm flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-[#040084] font-bold text-lg hover:text-black">&times;</button>
        </div>
    @endif

    {{-- Header & Navigation --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl sm:text-5xl font-bold text-black">Trash Projects</h1>
            <p class="text-slate-600 text-sm mt-1">Daftar proyek yang dihapus sementara (Soft Delete).</p>
        </div>

        <a href="{{ route('post.projects.index') }}"
            class="px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition">
            Kembali ke Projects
        </a>
    </div>

    {{-- Grid Trashed Cards --}}
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($trashedProjects as $project)
            <div class="p-6 rounded-2xl border border-black bg-slate-50 flex flex-col justify-between space-y-4 opacity-90">
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-semibold text-white bg-slate-600 px-3 py-1 rounded-full">
                            {{ $project->category ?? 'Web Application' }}
                        </span>
                        <span class="text-xs font-medium text-slate-500">
                            Dihapus: {{ $project->deleted_at->format('d M Y H:i') }}
                        </span>
                    </div>

                    <h2 class="text-2xl font-bold text-black line-through decoration-slate-400">
                        {{ $project->title }}
                    </h2>

                    <p class="text-slate-700 text-sm font-normal leading-relaxed">
                        {{ $project->description }}
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-between items-center pt-4 border-t border-slate-300">
                    <span class="text-xs font-medium text-slate-600">
                        Tech: {{ $project->technology ?? 'Laravel' }}
                    </span>

                    <div class="flex items-center gap-2">
                        {{-- Tombol Restore --}}
                        <form action="{{ route('post.projects.restore', $project->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-4 py-1.5 bg-emerald-800 hover:bg-emerald-700 text-white font-medium text-xs rounded-lg transition shadow">
                                Restore
                            </button>
                        </form>

                        {{-- Tombol Permanent Delete --}}
                        <form action="{{ route('post.projects.force-delete', $project->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini secara permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-1.5 bg-rose-800 hover:bg-rose-700 text-white font-medium text-xs rounded-lg transition shadow">
                                Hapus Permanen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-12 border border-dashed border-slate-300 rounded-2xl bg-white">
                <p class="text-slate-500 font-medium">Keranjang sampah kosong. Tidak ada proyek yang dihapus.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection