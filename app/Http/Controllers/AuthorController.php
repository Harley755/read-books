<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        return view('authors.index', [
            'authors' => Author::orderBy('name', 'asc')->get()
        ]);
    }

    public function create() {
        return view('authors.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255'
        ]);
       
        Author::create([
            'name' => $request->name
        ]);

        return redirect(route('authors.index'));
    }

    public function edit(Author $author) {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author) {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $author->update($request->all());
        return redirect(route('authors.index'));
    }

    public function destroy(Author $author) {
        $author->delete();
        return redirect(route('authors.index'));
    }  
}
