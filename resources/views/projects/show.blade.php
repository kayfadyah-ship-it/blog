@extends('layouts.app')

@section('title', $project->title . ' - Detail Proyek')

@section('content')
<div class="w-full max-w-4xl my-auto space-y-4">
    <h1 class="text-3xl sm:text-4xl font-bold text-black">{{ $project->title }}</h1>
    
    <p class="text-sm text-slate-700">Tanggal : {{ $project->created_at->format('d-m-Y H:i') }}</p>
    
    {{-- Thumbnail Gambar Proyek --}}
    @if($project->thumbnail)
        <div class="my-4">
            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full max-h-96 object-cover rounded-2xl shadow">
        </div>
    @endif

    <p class="text-slate-800 text-base leading-relaxed pt-2">
        {{ $project->description }}
    </p>

    <div class="flex items-center space-x-2 text-sm pt-4">
        @if(auth()->check())
            <a href="{{ route('post.projects.edit', $project->id) }}" class="text-[#040084] hover:underline">Edit</a>
            <span class="text-slate-800">|</span>
            
            <form id="delete-form-{{ $project->id }}" action="{{ route('post.projects.destroy', $project->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete()" class="text-red-600 hover:underline">
                    Delete
                </button>
            </form>
            <span class="text-slate-800">|</span>
        @endif
        
        <a href="{{ route('projects.index') }}" class="text-[#040084] hover:underline">Back to List</a>
    </div>

    {{-- ================= BAGIAN GALERI & UPLOAD ================= --}}
    @if($project->images && $project->images->count() > 0)
        <div class="pt-8 space-y-4 border-t border-slate-200 mt-6">
            <h3 class="text-2xl font-bold text-black">Galeri Proyek</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($project->images as $img)
                    <div class="rounded-2xl overflow-hidden border border-black shadow-sm bg-white flex flex-col justify-between">
                        
                        {{-- 1. Gambarnya (Diberi Batas Tinggi & Terpotong Rapi) --}}
                        <div class="w-full h-56 bg-slate-100 border-b border-black overflow-hidden">
                            <img src="{{ asset('storage/' . $img->image) }}" alt="Gallery Image" class="w-full h-full object-cover">
                        </div>

                        {{-- 2. Area Kontrol Form di Bawah Gambar --}}
                        <div class="p-4 space-y-3 bg-white">
                            @if(!auth()->check())
                                <p class="text-sm text-slate-700 font-medium">
                                    {{ $img->caption ?: 'Tidak ada caption' }}
                                </p>
                            @else
                                {{-- Baris Input File, Tombol Ganti, dan Tombol Hapus (SEJAJAR) --}}
                                <div class="space-y-1.5 border-b border-slate-200 pb-3">
                                    <label class="block text-xs font-semibold text-slate-700">Pengaturan Gambar:</label>
                                    
                                    <div class="flex items-center gap-1.5">
                                        {{-- Form Ganti Gambar --}}
                                        <form action="{{ route('post.projects.gallery.updateImage', [$project->id, $img->id]) }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-1 flex-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="file" name="image" required class="w-full text-xs file:mr-1 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-200 file:text-slate-700 cursor-pointer border border-slate-300 rounded-lg p-0.5">
                                            <button type="submit" class="bg-slate-800 hover:bg-black text-white text-xs font-medium px-2.5 py-1.5 rounded-lg transition whitespace-nowrap">
                                                Ganti
                                            </button>
                                        </form>

                                        {{-- Form Hapus Gambar --}}
                                        <form action="{{ route('post.projects.gallery.destroy', [$project->id, $img->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus foto ini dari galeri?')" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold px-2.5 py-1.5 rounded-lg transition whitespace-nowrap">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Tampilkan Error Validasi Ganti Gambar Jika Berkas Ditolak --}}
                                    @error('image')
                                        <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Form Edit Caption --}}
                                <form action="{{ route('post.projects.gallery.updateCaption', [$project->id, $img->id]) }}" method="POST" class="flex flex-col gap-1.5 pt-1">
                                    @csrf
                                    @method('PUT')
                                    <label class="block text-xs font-semibold text-slate-700">Caption:</label>
                                    <input type="text" name="caption" value="{{ $img->caption }}" placeholder="Tulis caption..." class="w-full text-xs border border-slate-300 rounded-lg px-2.5 py-1.5 focus:ring-[#040084] focus:border-[#040084]">
                                    <button type="submit" class="w-full bg-[#040084] hover:bg-blue-900 text-white text-xs font-semibold py-1.5 rounded-lg transition">
                                        Simpan Caption
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Form Upload Galeri Baru --}}
    @if(auth()->check())
        <div class="mt-8 p-6 bg-slate-50 border border-black rounded-2xl space-y-3">
            <h4 class="font-bold text-lg text-black">Tambah Foto Galeri</h4>
            <p class="text-xs text-slate-600 mb-2">Maksimal 10 gambar per proyek. Lebar minimal 800px.</p>
            
            <form action="{{ route('post.projects.gallery.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-3">
                @csrf
                <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#040084] file:text-white hover:file:bg-blue-900 cursor-pointer border border-slate-300 rounded-xl bg-white p-1">
                <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-[#040084] hover:bg-blue-900 text-white font-medium text-sm rounded-xl transition whitespace-nowrap shadow">
                    Upload Galeri
                </button>
            </form>
            
            @error('images')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
            @error('images.*')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
    @endif

</div>

<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus proyek ini?')) {
            document.getElementById('delete-form-{{ $project->id }}').submit();
        }
    }
</script>
@endsection