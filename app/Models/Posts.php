<?php

namespace App\Models;

use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'category_id'
    ];
}
