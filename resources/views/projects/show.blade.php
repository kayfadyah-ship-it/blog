@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <small>Tanggal: {{ $project->created_at }}</small>
        <hr>
        <p>{{ $project->description }}</p>
        <br>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali ke Daftar Projek</a>
    </div>
</div>
@endsection