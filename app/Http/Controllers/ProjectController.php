<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = project::all();
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
        ], [
            'title.min' => 'Title harus memiliki minimal 5 karakter.',
            'description.min' => 'Description harus memiliki minimal 10 karakter.',
        ]);

        project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $project = project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit(string $id)
    {
        $project = project::findOrFail($id);
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

        $project = project::findOrFail($id);
        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $project = project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus!');
    }
}