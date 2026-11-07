<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{
    // Upload multiple galeri & validasi dimensi
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images'   => 'required|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2000|dimensions:min_width=800', // Perbaikan: ganti image.* jadi images.*
        ], [
            'images.max'          => 'Maksimal hanya boleh mengunggah 10 gambar per project.',
            'images.*.image'      => 'Berkas harus berupa gambar.',
            'images.*.mimes'      => 'Format berkas harus berupa jpg, jpeg, png, atau webp.',
            'images.*.dimensions' => 'Lebar gambar minimal harus 800pixel.'
        ]);

        // Proteksi tambahan: cek total gambar yang sudah ada di database agar tidak melebihi 10
        if ($project->images()->count() + count($request->file('images')) > 10) {
            return back()->withErrors(['images' => 'Total keseluruhan gambar galeri tidak boleh lebih dari 10.']);
        }

        foreach ($request->file('images') as $file) {
            $project->images()->create([
                'image' => $file->store('projects/gallery', 'public'),
            ]);
        }

        return back()->with('success', 'Gambar galeri berhasil diunggah!');
    }

    // Ganti Gambar Galeri
    public function updateImage(Request $request, Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2000|dimensions:min_width=800',
        ], [
            'image.required'   => 'Pilih gambar pengganti terlebih dahulu.',
            'image.image'      => 'Berkas harus berupa gambar.',
            'image.mimes'      => 'Format berkas harus berupa jpg, jpeg, png, atau webp.',
            'image.dimensions' => 'Lebar gambar minimal harus 800pixel.',
        ]);

        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }

        $path = $request->file('image')->store('projects/gallery', 'public');

        $image->update([
            'image' => $path,
        ]);

        return back()->with('success', 'Gambar galeri berhasil diganti!');
    }

    // Menghapus Gambar Galeri
    public function destroy(Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar galeri berhasil dihapus!');
    }

    // Edit Caption
    public function updateCaption(Request $request, Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $image->update([
            'caption' => $request->caption,
        ]);

        return back()->with('success', 'Caption berhasil diperbarui!');
    }
}