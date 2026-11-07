@extends('layouts.app')

@section('title', 'Projects - Kayfa Dyah Wulandari')

@section('content')
    <div class="space-y-6 my-auto w-full">

        @if(session('success'))
            <div class="p-4 rounded-xl border border-black bg-[#040084]/10 text-[#040084] font-medium text-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-[#040084] font-bold text-lg hover:text-black">&times;</button>
            </div>
        @endif

        <div class="flex justify-between items-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-black">Projects</h1>

            @if(auth()->check() && (auth()->user()->is_admin || auth()->user()->role === 'admin'))
                <div class="flex items-center gap-3">
                    <a href="{{ route('post.projects.create') }}" class="px-5 py-2.5 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition shadow">
                        Tambah Proyek Baru
                    </a>

                    <a href="{{ route('projects.trash') }}" class="px-5 py-2.5 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition shadow">
                        Trash
                    </a>
                </div>
            @endif
        </div>

        <form method="GET" action="{{ request()->fullUrl() }}" class="flex flex-col sm:flex-row gap-3 items-center">
            <select name="per_page" onchange="this.form.submit()" class="px-4 py-2 border border-slate-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#040084]">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 per halaman</option>
                <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10 per halaman</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per halaman</option>
            </select>

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul proyek..." class="w-full px-4 py-2 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#040084]" />

            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition shadow">
                Cari
            </button>
        </form>

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($projects as $index => $project)
                <div class="p-6 rounded-2xl border border-black bg-white flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        @if($project->thumbnail)
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover rounded-xl mb-3">
                        @endif

                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-lg">
                                    #{{ $projects->firstItem() + $index }}
                                </span>

                                @if(auth()->check() && (auth()->user()->is_admin || auth()->user()->role === 'admin'))
                                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full {{ strtolower($project->status) === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ ucfirst($project->status ?? 'Draft') }}
                                    </span>
                                @endif
                            </div>

                            <span class="text-base font-normal text-[#040084]">
                                {{ $project->category->name ?? $project->category ?? 'Web Application' }}
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

                        <a href="{{ route('projects.show', $project->id) }}" class="text-xs font-normal text-black hover:underline">
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