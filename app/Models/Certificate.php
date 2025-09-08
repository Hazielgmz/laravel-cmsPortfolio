<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificates';

    protected $fillable = [
        'title',
        'issuer',
        'type',
        'date',
        'certificate_url',
        'visible'
    ];

    protected $casts = [
        'visible' => 'boolean',
        'date' => 'date'
    ];
    
    /**
     * The tools that belong to the certificate.
     */
    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'certificate_tool');
    }
}