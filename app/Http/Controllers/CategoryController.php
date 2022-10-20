<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('categories.index', [
            'categories' => Category::orderBy('name', 'asc')->get()
        ]);
    }    

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255'
        ]);
       
        Category::create([
            'name' => $request->name
        ]);

        return redirect(route('categories.index'));
    }

    public  function edit(Category $category) {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $category->update($request->all());

        return redirect(route('categories.index'));
    }

    public function destroy(Request $request, Category $category) {
    
        $category->delete();

        return redirect(route('categories.index'));
    }
}