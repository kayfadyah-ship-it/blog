@extends('layouts.app')

@section('title', 'Edit Skill - Kayfa Dyah Wulandari')

@section('content')
<div class="w-full max-w-2xl my-auto space-y-6">
    <h1 class="text-4xl sm:text-5xl font-bold text-black">Edit Skill</h1>

    <form action="{{ route('post.skills.update', $skill->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="space-y-1">
            <label for="name" class="block text-xl font-normal text-black">Nama Skill</label>
            <input type="text" id="name" name="name" value="{{ old('name', $skill->name) }}" required
                class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">
            @error('name')
                <p class="text-red-600 text-xs font-medium pt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Persentase jika tabel skills memiliki kolom percentage --}}
        @if(isset($skill->percentage))
            <div class="space-y-1">
                <label for="percentage" class="block text-xl font-normal text-black">Persentase (%)</label>
                <input type="number" id="percentage" name="percentage" value="{{ old('percentage', $skill->percentage) }}" min="1" max="100"
                    class="w-full p-3 border border-black rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black">
                @error('percentage')
                    <p class="text-red-600 text-xs font-medium pt-1">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <div class="flex justify-end gap-3 pt-4">
            <button type="submit"
                class="px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition">
                Simpan Perubahan
            </button>
            <a href="{{ route('post.skills.index') }}"
                class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-black font-medium text-sm rounded-xl transition no-underline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection