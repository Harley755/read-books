<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Image;
use App\Models\Author;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('images.index', [
            'images' => Image::all()
        ]);
    }

    public function create(Request $request) {
        
        return view('images.create', [
            'books' => Book::all(),
            'authors' => Author::all()
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'image_path' => 'required',
            'author_id' => 'required',
            'book_id' => 'required'
        ]);

        $filename = time() . '.' . $request->image_path->extension();

        $image_path = $request->file('image_path')->storeAs(
            'images-book-author',
            $filename,
            'public'
        );
        
        if ($request->input('same_name') == "author") {
            $type = 'App\Models\Author';
            Image::create([
                'imageable_id' => $request->author_id,
                'image_path' => $image_path,
                'imageable_type' => $type,
            ]);
        } else {
            $type = 'App\Models\Book';
            Image::create([
                'imageable_id' => $request->book_id,
                'imageable_type' => $type,
                'image_path' => $image_path,
            ]);
        }
        return redirect()->route('images.index');
    }

    public function edit(Image $image) {
        $books = Book::all();
        $authors = Author::all();
        return view('images.edit', compact('image', 'books', 'authors'));
    }

    public function update(Request $request, Image $image) {
        $request->validate([
            'image_path' => 'required',
            'author_id' => 'required',
            'book_id' => 'required'
        ]);

        $filename = time() . '.' . $request->image_path->extension();

        $image_path = $request->file('image_path')->storeAs(
            'images-book-author',
            $filename,
            'public'
        );
        
        if ($request->input('same_name') == "author") {
            $type = 'App\Models\Author';
            $image->update([
                'imageable_id' => $request->author_id,
                'image_path' => $image_path,
                'imageable_type' => $type,
            ]);
        } else {
            $type = 'App\Models\Book';
            $image->update([
                'imageable_id' => $request->book_id,
                'imageable_type' => $type,
                'image_path' => $image_path,
            ]);
        }
        return redirect()->route('images.index');
    }
    
}
