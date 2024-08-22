<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'is_completed'];

    public function scopeUniqueTitle($query, $title)
    {
        return $query->where('title', $title)->exists();
    }
}
