<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    protected $table = 'careers';
    
    protected $fillable = [
        'position',
        'company',
        'period',
        'description',
        'contact',
        'visible'
    ];
    
    protected $casts = [
        'visible' => 'boolean'
    ];
}
