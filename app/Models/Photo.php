<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'caption',
        'user_id',
        'images'
    ];

    // convert images json format to array automatically 
    protected $casts = [
        'images' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
