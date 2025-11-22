<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'image',
        'technologies',
        'project_url',
        'github_url',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_active' => 'boolean'
    ];
}