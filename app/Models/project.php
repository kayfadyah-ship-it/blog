<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'technology',
        'status',
    ];

    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where('title', 'like', "%{$keyword}%")
                     ->orWhere('description', 'like', "%{$keyword}%");
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}
