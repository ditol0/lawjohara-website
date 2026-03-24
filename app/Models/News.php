<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'uuid','title','slug','excerpt','content','cover_image','is_published','published_at'
    ];
    protected $casts = [
    'published_at' => 'datetime',
];

    
}