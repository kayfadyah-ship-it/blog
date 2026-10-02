@extends('layouts.app')

@section('title', 'Tambah Projects - Kayfa Dyah Wulandari')

@section('content')
<div class="w-full max-w-2xl my-auto space-y-6">
    <h1 class="text-4xl sm:text-5xl font-bold text-black">Tambah Projects</h1>

    <form action="{{ route('projects.store') }}" method="POST" class="space-y-5">
        @csrf

        <div class="space-y-1">
            <label for="title" class="block text-xl font-normal text-black">Nama proyek</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">
            @error('title')
                <p class="text-red-600 text-xs font-medium pt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="description" class="block text-xl font-normal text-black">Description</label>
            <textarea id="description" name="description" rows="4" required
                class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-xs font-medium pt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="category" class="block text-xl font-normal text-black">Kategori Proyek</label>
            <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="Contoh: Web Application, Game Development"
                class="w-full p-3 border border-black rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-black">
        </div>

        <div class="space-y-1">
            <label for="technology" class="block text-xl font-normal text-black">Tools</label>
            <input type="text" id="technology" name="technology" value="{{ old('technology') }}" placeholder="Contoh: Laravel, Python, Java"
                class="w-full p-3 border border-black rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-black">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id =" status " name =" status " >
                <option value ="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value ="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
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