@extends('layouts.app')

@section('title', 'Projects - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-8">
    <div class="border-b border-slate-800 pb-4">
        <h1 class="text-3xl font-bold text-slate-800">Proyek Portofolio</h1>
        <p class="text-slate-600 text-sm mt-1">Daftar proyek dan aplikasi yang pernah saya kerjakan.</p>
    </div>

    {{-- Form Search, Filter Kategori, Technology, & Sorting --}}
    <form method="GET" action="{{ route('projects.index') }}" class="flex flex-wrap gap-3 items-center">
        {{-- Input Pencarian --}}
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari judul atau deskripsi proyek..."
            class="rounded-lg border border-slate-300 px-4 py-2 text-sm text-slate-800 flex-1 min-w-[220px] focus:outline-none focus:border-blue-500">

        {{-- Filter Kategori --}}
        <select name="category" class="rounded-lg border border-slate-300 pl-4 pr-10 py-2 text-sm text-slate-800 focus:outline-none focus:border-blue-500">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $c)
                <option value="{{ $c->slug }}" {{ request('category') === $c->slug ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>

        {{-- Filter Technology --}}
        <select name="technology" class="rounded-lg border border-slate-300 pl-4 pr-10 py-2 text-sm text-slate-800 focus:outline-none focus:border-blue-500">
            <option value="">Semua Teknologi</option>
            @foreach ($technologies as $tech)
                <option value="{{ $tech->slug ?? $tech->id }}" {{ request('technology') == ($tech->slug ?? $tech->id) ? 'selected' : '' }}>
                    {{ $tech->name }}
                </option>
            @endforeach
        </select>

        {{-- Pengurutan (Sorting + project_date) --}}
        <select name="sort" class="rounded-lg border border-slate-300 pl-4 pr-10 py-2 text-sm text-slate-800 focus:outline-none focus:border-blue-500">
            <option value="">Terbaru (Dibuat)</option>
            <option value="terlama" {{ request('sort') === 'terlama' ? 'selected' : '' }}>Terlama (Dibuat)</option>
            <option value="date_desc" {{ request('sort') === 'date_desc' ? 'selected' : '' }}>Tanggal Proyek Terbaru</option>
            <option value="date_asc" {{ request('sort') === 'date_asc' ? 'selected' : '' }}>Tanggal Proyek Terlama</option>
            <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>A - Z</option>
        </select>

        <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
            Filter
        </button>

        {{-- Tombol Reset jika ada filter yang sedang aktif --}}
        @if(request()->hasAny(['search', 'category', 'technology', 'sort']))
            <a href="{{ route('projects.index') }}" class="border border-slate-300 hover:bg-slate-100 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                Reset
            </a>
        @endif
    </form>

    {{-- Jumlah Hasil Ditemukan --}}
    <p class="text-sm font-medium text-slate-700">
        {{ $projects->total() }} hasil ditemukan
    </p>

    {{-- Daftar Proyek Dinamis dari Database --}}
    <div class="grid md:grid-cols-2 gap-6">
        @forelse ($projects as $project)
            <div class="p-6 rounded-xl border border-slate-200 bg-slate-800/30 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        @if($project->category)
                            <span class="inline-block text-xs font-semibold text-blue-900 bg-blue-500/10 px-2.5 py-1 rounded border border-blue-500/20">
                                {{ $project->category }}
                            </span>
                        @endif

                        @if($project->project_date)
                            <span class="text-xs text-slate-500">
                                {{ \Carbon\Carbon::parse($project->project_date)->format('d M Y') }}
                            </span>
                        @endif
                    </div>

                    <h2 class="text-xl font-bold text-slate-800">
                        <a href="{{ route('projects.show', $project->id) }}" class="hover:text-blue-700 transition">
                            {{ $project->title }}
                        </a>
                    </h2>

                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ $project->short_description ?? Str::limit($project->description, 120) }}
                    </p>
                </div>

                {{-- Badge Technologies (Many-to-Many + fallback kolom lama) --}}
                <div class="flex flex-wrap gap-2 pt-2">
                    @forelse ($project->technologies as $tech)
                        <span class="text-xs bg-slate-800 text-slate-300 px-2.5 py-1 rounded">
                            {{ $tech->name }}
                        </span>
                    @empty
                        @if($project->technology)
                            <span class="text-xs bg-slate-800 text-slate-300 px-2.5 py-1 rounded">
                                {{ $project->technology }}
                            </span>
                        @endif
                    @endforelse
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 border border-dashed border-slate-300 rounded-xl">
                <p class="text-slate-600 text-sm">Tidak ada proyek yang sesuai dengan pencarian atau filter.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="pt-4">
        {{ $projects->links() }}
    </div>
</div>
@endsection