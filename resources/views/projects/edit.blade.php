@extends('layouts.app')

@section('title', 'Edit Projects - Kayfa Dyah Wulandari')

@section('content')
<div class="w-full max-w-2xl my-auto space-y-6">
    <h1 class="text-4xl sm:text-5xl font-bold text-black">Edit Projects</h1>

    <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="space-y-1">
            <label for="title" class="block text-xl font-normal text-black">Nama proyek</label>
            <input type="text" id="title" name="title" value="{{ $project->title }}" required
                class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">
        </div>

        <div class="space-y-1">
            <label for="description" class="block text-xl font-normal text-black">Description</label>
            <textarea id="description" name="description" rows="4" required
                class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">{{ $project->description }}</textarea>
        </div>

        <div class="space-y-1">
            <label for="category" class="block text-xl font-normal text-black">Kategori Proyek</label>
            <input type="text" id="category" name="category" value="{{ $project->category }}"
                class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">
        </div>

        <div class="space-y-1">
            <label for="technology" class="block text-xl font-normal text-black">Tools</label>
            <input type="text" id="technology" name="technology" value="{{ $project->technology }}"
                class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <button type="submit"
                class="px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition">
                Submit
            </button>
            <a href="{{ route('projects.index') }}"
                class="px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition no-underline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection