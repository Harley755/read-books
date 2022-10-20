<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return view('books.index', [
            'books' => Book::all(),
            'categories' => Category::orderBy('name', 'asc')->get(),
        ]);
    }

    public function create() {
        return view('books.create', [
            'categories' => Category::all(),
            'authors' => Author::all(),
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'nbre_pages' => 'required',
            'category_id' => 'required',
            'category_id' => 'required',
            'book_path' => 'required',
        ]);

        $filename = time() . '.' . $request->book_path->extension();

        $book_path = $request->file('book_path')->storeAs(
            'books_pdf',
            $filename,
            'public'
        );
        
        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'nbre_pages' => $request->nbre_pages,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'book_path' => $book_path,
        ]);

        return redirect()->route('books.index');
    }

    public function edit(Book $book, Category $category) {
        return view('books.edit', compact('book'));
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index');
    }
}
