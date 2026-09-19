@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Tambah Projek Portofolio</h1>

            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title / Judul Projek</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description / Deskripsi</label>
                    <textarea class="form-control" id="description" rows="5" name="description" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 text-sm font-bold mb-2">Kategori Projek</label>
                    <input type="text" name="category" placeholder="Contoh: Web Application, Game Development"
                        class="w-full p-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 text-sm font-bold mb-2">Teknologi/Tools</label>
                    <input type="text" name="technology" placeholder="Contoh: Laravel, Java, Project Management"
                        class="w-full p-2 border rounded-lg">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection