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

        <!-- Form Search & Filter Per Halaman -->
        <form method="GET" action="{{ route('projects.index') }}" class="flex flex-col sm:flex-row gap-3 items-center">
            <!-- Dropdown Pilihan Jumlah Data Per Halaman -->
            <select name="per_page" onchange="this.form.submit()" class="px-4 py-2 border border-slate-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#040084]">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 per halaman</option>
                <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10 per halaman</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per halaman</option>
            </select>

            <!-- Input Search Judul -->
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Cari judul proyek..." 
                class="w-full px-4 py-2 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#040084]"
            />

            <!-- Tombol Cari -->
            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition shadow">
                Cari
            </button>
        </form>

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Menggunakan $index untuk menghitung nomor urut berlanjut --}}
            @forelse($projects as $index => $project)
                <div class="p-6 rounded-2xl border border-black bg-white flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            {{-- Nomor urut berlanjut antar-halaman --}}
                            <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-lg">
                                #{{ $projects->firstItem() + $index }}
                            </span>

                            <span class="text-base font-normal text-[#040084]">
                                {{ $project->category ?? 'Web Application' }}
                            </span>
                        </div>

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

        {{-- Section Info & Tombol Navigasi Pagination --}}
        <div class="space-y-2 pt-4">
            <div class="text-sm text-slate-600">
                Halaman : {{ $projects->currentPage() }} <br>
                Jumlah Data : {{ $projects->total() }} <br>
                Data Per Halaman : {{ $projects->perPage() }}
            </div>

            <div class="mt-4">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
@endsection