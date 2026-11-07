<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Project::query();

        if (!auth()->check() || (!auth()->user()->is_admin && auth()->user()->role !== 'admin')) {
            $query->where('status', 'published');
        }

        $projects = $query->when($search, function ($q, $search) {
                return $q->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->appends($request->all());

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        // Ambil data kategori untuk pilihan dropdown di form tambah
        $categories = Category::all();
        return view('projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'category'    => 'nullable|string',
            'technology'  => 'nullable|string',
            'status'      => 'nullable|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'title.min'       => 'Title harus memiliki minimal 5 karakter.',
            'description.min' => 'Description harus memiliki minimal 10 karakter.',
            'thumbnail.image' => 'Berkas harus berupa gambar (jpg, jpeg, png, webp).',
            'thumbnail.max'   => 'Ukuran file thumbnail tidak boleh lebih dari 2MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $project = Project::with('images')->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::all();
        return view('projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'category'    => 'nullable|string',
            'technology'  => 'nullable|string',
            'status'      => 'nullable|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'title.min'       => 'Title harus memiliki minimal 5 karakter.',
            'description.min' => 'Description harus memiliki minimal 10 karakter.',
            'thumbnail.image' => 'Berkas harus berupa gambar (jpg, jpeg, png, webp).',
            'thumbnail.max'   => 'Ukuran file thumbnail tidak boleh lebih dari 2MB.',
        ]);

        $project = Project::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }
        
        $project->update($validated);

        return redirect()->route('post.projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('post.projects.index')->with('success', 'Proyek berhasil dihapus! (soft delete)');
    }

    public function trash()
    {
        $trashedProjects = Project::onlyTrashed()->get();
        return view('projects.trash', compact('trashedProjects'));
    }

    public function restore(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.trash')->with('success', 'Proyek berhasil dipulihkan!');
    }

    public function forceDelete(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        if ($project->images) {
            foreach ($project->images as $img) {
                Storage::disk('public')->delete($img->image);
            }
        }

        $project->forceDelete();

        return redirect()->route('projects.trash')->with('success', 'Proyek berhasil dihapus permanen!');
    }
}