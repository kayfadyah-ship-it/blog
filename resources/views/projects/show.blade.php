@extends('layouts.app')

@section('title', $project->title . ' - Detail Proyek')

@section('content')
<div class="w-full max-w-4xl my-auto space-y-4">
    <h1 class="text-3xl sm:text-4xl font-bold text-black">{{ $project->title }}</h1>
    
    <p class="text-sm text-slate-700">Tanggal : {{ $project->created_at->format('d-m-Y H:i') }}</p>
    
    <p class="text-slate-800 text-base leading-relaxed pt-2">
        {{ $project->description }}
    </p>

    <div class="flex items-center space-x-2 text-sm pt-4">
        <a href="{{ route('projects.edit', $project->id) }}" class="text-[#040084] hover:underline">Edit</a>
        <span class="text-slate-800">|</span>
        
        <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete()" class="text-red-600 hover:underline">
                Delete
            </button>
        </form>
        
        <span class="text-slate-800">|</span>
        <a href="{{ route('projects.index') }}" class="text-[#040084] hover:underline">Back to List</a>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus proyek ini?')) {
            document.getElementById('delete-form-{{ $project->id }}').submit();
        }
    }
</script>
@endsection