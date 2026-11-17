@extends('layouts.app')

@section('title', 'Tambah Projects - Kayfa Dyah Wulandari')

@section('content')
<div class="w-full max-w-2xl my-auto space-y-6">
    <h1 class="text-4xl sm:text-5xl font-bold text-black">Tambah Projects</h1>

    <form action="{{ route('post.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
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

        {{-- Dropdown Kategori --}}
        <div class="space-y-1">
            <label for="category" class="block text-xl font-normal text-black">Kategori Proyek</label>
            <select id="category" name="category" required class="w-full p-3 border border-black rounded-xl text-sm bg-white focus:outline-none focus:ring-1 focus:ring-black">
                <option value="" disabled selected>-- Pilih Kategori Proyek --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}" {{ old('category') == $cat->name ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Checkbox Technologies (Many-to-Many) --}}
        <div class="space-y-2">
            <label class="block text-xl font-normal text-black">Tools / Teknologi</label>
            <div class="flex flex-wrap gap-3 p-3 border border-black rounded-xl bg-white">
                @foreach($technologies as $tech)
                    <label class="inline-flex items-center gap-2 text-sm text-black cursor-pointer">
                        <input type="checkbox" name="technologies[]" value="{{ $tech->id }}"
                            {{ in_array($tech->id, old('technologies', [])) ? 'checked' : '' }}
                            class="rounded border-slate-400 text-[#040084] focus:ring-[#040084]">
                        <span>{{ $tech->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('technologies')
                <p class="text-red-600 text-xs font-medium pt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Tanggal Proyek (project_date) --}}
        <div class="space-y-1">
            <label for="project_date" class="block text-xl font-normal text-black">Tanggal Proyek</label>
            <input type="date" id="project_date" name="project_date" value="{{ old('project_date') }}"
                class="w-full p-3 border border-black rounded-xl text-sm bg-white focus:outline-none focus:ring-1 focus:ring-black">
            @error('project_date')
                <p class="text-red-600 text-xs font-medium pt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="thumbnail" class="block text-xl font-normal text-black">Thumbnail Gambar</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                class="w-full p-2 border border-black rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#040084] file:text-white hover:file:bg-blue-900">
            @error('thumbnail')
                <p class="text-red-600 text-xs font-medium pt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="status" class="block text-xl font-normal text-black">Status</label>
            <select id="status" name="status" class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black bg-white">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') == 'published' || !old('status') ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <button type="submit"
                class="px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition">
                Submit
            </button>
            <a href="{{ route('post.projects.index') }}"
                class="px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition no-underline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection