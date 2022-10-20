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
        $this->authorize('create', Book::class);

        return view('books.create', [
            'categories' => Category::all(),
            'authors' => Author::all(),
        ]);
    }

    public function store(Request $request, Book $book) {
        $this->authorize('create', $book);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'nbre_pages' => 'required',
            'category_id' => 'required',
            'author_id' => 'required',
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

    public function edit(Book $book) {
        $this->authorize('update', $book);

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book) {
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'nbre_pages' => 'required',
            'category_id' => 'required',
            'author_id' => 'required',
            'book_path' => 'required',
        ]);

        $filename = time() . '.' . $request->book_path->extension();

        $book_path = $request->file('book_path')->storeAs(
            'books_pdf',
            $filename,
            'public'
        );

        $book->update($request->$book_path);
        $book->update($request->except(['book_path']));
        return redirect(route('books.index'));
    }

    public function destroy(Book $book) {
        $this->authorize('delete', $book);

        $book->delete();
        return redirect()->route('books.index');
    }
}
