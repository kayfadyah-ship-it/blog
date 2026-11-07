<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Project::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i <= 25; $i++) {
            Project::create([
                'title' => 'Post Judul Ke-' . $i,
                'description' => 'Deskripsi untuk post judul ke-' . $i,
                'category' => 'Web Application',
                'technology' => 'PHP, Laravel',
                'status' => 'published',
            ]);
        }
    }
}

