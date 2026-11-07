@extends('layouts.app')

@section('content')
<div class="space-y-6 my-auto w-full">
    <h1 class="text-4xl sm:text-5xl font-bold text-black">Dashboard</h1>

    {{-- Grid Card Statistik --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <x-stat-card label="Projects" :value="$totalProjects" color="text-[#040084]" />
        <x-stat-card label="Categories" :value="$totalCategories" color="text-green-600" />
        <x-stat-card label="Technologies" :value="$totalTechnologies" color="text-purple-600" />
        <x-stat-card label="Skills" :value="$totalSkills" color="text-orange-600" />
        
        <x-stat-card label="Published" :value="$totalPublished" color="text-emerald-600" />
        <x-stat-card label="Draft" :value="$totalDraft" color="text-amber-600" />
    </div>

    <div class="p-6 bg-white border border-black rounded-2xl space-y-4">
        <h2 class="text-xl font-bold text-black">Statistik Kategori</h2>
        <div class="flex gap-4 flex-wrap">
            @foreach($categoriesWithCount as $category)
                <div class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm">
                    <span class="font-bold text-black">{{ $category->name }}</span>: 
                    <span class="text-[#040084] font-semibold">{{ $category->projects_count }} Project</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Tabel 5 Project Terbaru --}}
    <div class="p-6 bg-white border border-black rounded-2xl space-y-4">
        <h2 class="text-xl font-bold text-black">Project Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-100 text-slate-900 border-b border-slate-200">
                    <tr>
                        <th class="p-3">Judul</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestProjects as $project)
                        <tr class="border-b border-slate-100">
                            <td class="p-3 font-medium text-black">{{ $project->title }}</td>
                            <td class="p-3">{{ $project->category->name ?? $project->category ?? '-' }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded-full {{ $project->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $project->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center text-slate-500">Belum ada proyek.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection