<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    // 1. Menampilkan daftar skill
    public function index()
    {
        $skills = Skill::latest()->get();
        return view('skills.index', compact('skills'));
    }

    // 2. Menampilkan form tambah skill baru (Ini yang bikin error tadi karena hilang)
    public function create()
    {
        return view('skills.create');
    }

    // 3. Memproses simpan skill baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
        ], [
            'name.required'       => 'Nama skill wajib diisi.',
            'name.max'            => 'Nama skill maksimal 255 karakter.',
            'percentage.required' => 'Persentase skill wajib diisi.',
            'percentage.numeric'  => 'Persentase harus berupa angka.',
            'percentage.min'      => 'Persentase minimal 0.',
            'percentage.max'      => 'Persentase maksimal 100.',
        ]);

        Skill::create($validated);

        return redirect()->route('post.skills.index')->with('success', 'Skill baru berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit skill
    public function edit(Skill $skill)
    {
        return view('skills.edit', compact('skill'));
    }

    // 5. Memproses update data skill
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
        ], [
            'name.required'       => 'Nama skill wajib diisi.',
            'name.max'            => 'Nama skill maksimal 255 karakter.',
            'percentage.required' => 'Persentase skill wajib diisi.',
            'percentage.numeric'  => 'Persentase harus berupa angka.',
            'percentage.min'      => 'Persentase minimal 0.',
            'percentage.max'      => 'Persentase maksimal 100.',
        ]);

        $skill->update($validated);

        return redirect()->route('post.skills.index')->with('success', 'Skill berhasil diperbarui!');
    }

    // 6. Hapus skill (Opsional)
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('post.skills.index')->with('success', 'Skill berhasil dihapus!');
    }
}