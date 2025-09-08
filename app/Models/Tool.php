<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $table = 'tools';

    protected $fillable = [
        'name',
        'type',
        'icon',
        'visible'
    ];

    protected $casts = [
        'visible' => 'boolean'
    ];
    
    /**
     * The projects that belong to the tool.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tool');
    }
    
    /**
     * The certificates that belong to the tool.
     */
    public function certificates()
    {
        return $this->belongsToMany(Certificate::class, 'certificate_tool');
    }
}