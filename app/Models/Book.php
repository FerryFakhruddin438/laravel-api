<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'publisher',
        'price',
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
