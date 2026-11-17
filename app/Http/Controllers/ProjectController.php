<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $isAdmin = auth()->check() && (auth()->user()->is_admin || auth()->user()->role === 'admin');

        $query = Project::with('technologies')
            // Jika bukan admin, hanya tampilkan yang published
            ->when(!$isAdmin, function ($q) {
                $q->where('status', 'published');
            })
            // Jika admin memilih filter status (published / draft)
            ->when($isAdmin && $request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            // Search judul, deskripsi singkat, atau deskripsi lengkap
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where(function ($w) use ($s) {
                    $w->where('title', 'like', "%{$s}%")
                      ->orWhere('short_description', 'like', "%{$s}%")
                      ->orWhere('description', 'like', "%{$s}%");
                });
            })
            // Filter kategori
            ->when($request->filled('category'), function ($q) use ($request) {
                $c = $request->category;
                $categoryName = Category::where('slug', $c)->value('name');
                $q->where('category', $categoryName ?? $c);
            })
            // Filter technology (Many-to-Many)
            ->when($request->filled('technology'), function ($q) use ($request) {
                $tech = $request->technology;
                $q->whereHas('technologies', function ($t) use ($tech) {
                    $t->where('slug', $tech)->orWhere('technologies.id', $tech);
                });
            });

        // Sorting (termasuk berdasarkan project_date)
        switch ($request->query('sort')) {
            case 'terlama':
                $query->oldest();
                break;
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'date_desc':
                $query->orderByDesc('project_date')->latest();
                break;
            case 'date_asc':
                $query->orderBy('project_date', 'asc')->oldest();
                break;
            default:
                $query->latest();
        }

        $perPage = $request->input('per_page', 10);
        $projects = $query->paginate($perPage)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        // Arahkan ke view admin jika diakses melalui /post/projects
        if ($request->is('post/projects*')) {
            return view('projects', compact('projects', 'categories', 'technologies'));
        }

        return view('projects.index', compact('projects', 'categories', 'technologies'));
    }

    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::orderBy('name')->get();
        return view('projects.create', compact('categories', 'technologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|min:5|max:255|unique:projects,title',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'required|string|min:10',
            'category'          => 'nullable|string',
            'technology'        => 'nullable|string',
            'technologies'      => 'nullable|array',
            'technologies.*'    => 'exists:technologies,id',
            'status'            => 'nullable|string',
            'project_date'      => 'nullable|date',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'project_url'       => 'nullable|url|max:255',
            'repository_url'    => 'nullable|url|max:255',
        ], [
            'title.min'       => 'Title harus memiliki minimal 5 karakter.',
            'description.min' => 'Description harus memiliki minimal 10 karakter.',
            'thumbnail.image' => 'Berkas harus berupa gambar (jpg, jpeg, png, webp).',
            'thumbnail.max'   => 'Ukuran file thumbnail tidak boleh lebih dari 2MB.',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        $technologyIds = $validated['technologies'] ?? [];
        unset($validated['technologies']);

        $project = Project::create($validated);
        $project->technologies()->attach($technologyIds);

        return redirect()->route('post.projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $project = Project::with(['images', 'technologies'])->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit(string $id)
    {
        $project = Project::with('technologies')->findOrFail($id);
        $categories = Category::all();
        $technologies = Technology::orderBy('name')->get();
        return view('projects.edit', compact('project', 'categories', 'technologies'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title'             => 'required|string|min:5|max:255',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'required|string|min:10',
            'category'          => 'nullable|string',
            'technology'        => 'nullable|string',
            'technologies'      => 'nullable|array',
            'technologies.*'    => 'exists:technologies,id',
            'status'            => 'nullable|string',
            'project_date'      => 'nullable|date',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'project_url'       => 'nullable|url|max:255',
            'repository_url'    => 'nullable|url|max:255',
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

        $technologyIds = $validated['technologies'] ?? [];
        unset($validated['technologies']);

        $project->update($validated);
        $project->technologies()->sync($technologyIds);

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