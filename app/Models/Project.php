<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'codeLink',
        'PreviewLink',
        'image',
        'visible'
    ];

    protected $casts = [
        'visible' => 'boolean',
        'date' => 'date'
    ];
    
    /**
     * The tools that belong to the project.
     */
    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'project_tool');
    }
}