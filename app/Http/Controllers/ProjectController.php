<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input search dan per_page dari request (default 10)
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        // 2. Query data dengan pencarian dan pagination
        $projects = Project::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->appends($request->all()); // Untuk menjaga parameter URL saat berpindah halaman

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'category' => 'nullable|string',
            'technology' => 'nullable|string',
            'status' => 'nullable|string',
        ], [
            'title.min' => 'Title harus memiliki minimal 5 karakter.',
            'description.min' => 'Description harus memiliki minimal 10 karakter.',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'category' => 'nullable|string',
            'technology' => 'nullable|string',
        ], [
            'title.min' => 'Title harus memiliki minimal 5 karakter.',
            'description.min' => 'Description harus memiliki minimal 10 karakter.',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus! (soft delete)!');
    }

    public function trash()
    {
        $trashedProjects = Project::onlyTrashed()->get();
        return view('projects.trash', compact('trashedProjects'));
    }

    // Mengembalikan data terhapus (Restore)
    public function restore(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.trash')->with('success', 'Proyek berhasil dipulihkan!');
    }

    // Hapus Permanen
    public function forceDelete(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('projects.trash')->with('success', 'Proyek berhasil dihapus permanen!');
    }
}