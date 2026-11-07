<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        //hitung nama per kategori 
        $categiriesWithCount = Category::all()->map(function ($cat){
            $cat->projects_count = Project::where('category', $cat->name)->count();
            return $cat;
        });


        return view('projects.dashboard', [
            'totalProjects'     => Project::count(),
            'totalCategories'   => Category::count(),
            'totalTechnologies' => Technology::count(),
            'totalSkills' => Skill::count(),
            'totalPublished'   => Project::where('status', 'published')->count(),
            'totalDraft'      => Project::where('status', 'draft')->count(),
            'categoriesWithCount' => $categiriesWithCount,
            'latestProjects'    => Project::latest('category')->latest()->take(5)->get(),
        ]);
    }
}
