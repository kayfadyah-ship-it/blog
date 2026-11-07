@extends('layouts.app')

@section('title', 'Skills - Kayfa Dyah Wulandari')

@section('content')
<div class="space-y-6 my-auto w-full">

    @if(session('success'))
        <div class="p-4 rounded-xl border border-black bg-[#040084]/10 text-[#040084] font-medium text-sm flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-[#040084] font-bold text-lg hover:text-black">&times;</button>
        </div>
    @endif

    {{-- Header & Tombol Tambah --}}
    <div class="flex justify-between items-center">
        <h1 class="text-4xl sm:text-5xl font-bold text-black">Skills</h1>

        @if(auth()->check())
            <a href="{{ route('post.skills.create') }}" class="px-5 py-2.5 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition shadow">
                Tambah Skill Baru
            </a>
        @endif
    </div>

    {{-- Grid Daftar Skill --}}
    <div class="grid md:grid-cols-2 gap-4">
        @forelse($skills as $skill)
            <div class="p-4 rounded-2xl border border-black bg-white flex justify-between items-center shadow-sm">
                <div>
                    <h3 class="text-lg font-bold text-black">{{ $skill->name }}</h3>
                </div>

                @if(auth()->check())
                    <a href="{{ route('post.skills.edit', $skill->id) }}" class="px-4 py-1.5 bg-[#040084] hover:bg-blue-900 text-white text-xs font-semibold rounded-lg transition">
                        Edit Skill
                    </a>
                @endif
            </div>
        @empty
            <div class="col-span-2 text-center py-8 border border-dashed border-slate-300 rounded-xl">
                <p class="text-slate-500 font-medium">Belum ada data skill.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection