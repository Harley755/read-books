<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'book_path',
        'nbre_pages',
        'category_id',
        'author_id',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the book's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
