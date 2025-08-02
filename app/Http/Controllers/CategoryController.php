<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use Illuminate\Support\Facades\Auth;    

class CategoryController extends Controller
{
    protected $isAdmin;

    public function __construct()
    {
        $this->isAdmin = Auth::check() && Auth::user()->is_admin == 1;
        
        if (!$this->isAdmin) {
            abort(403, 'Admin access required');
        }
    }   

    public function index() {
        return view('categories.index', [
            'categories' => Category::paginate(6)
        ]);
    }

    public function create() {
        return view('categories.create');
    }

    public function store(CategoryStoreRequest $request) {
        $request->validated();

        $category = new Category();
        $category->name = $request->name;
        if(str_word_count($request->name) > 1) {
            $category->slug = strtolower(str_replace(' ', '-', $request->name));
        } else {
            $category->slug = strtolower($request->name);
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category) {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category) {
        $request->validated();

        $category->name = $request->name;
        if(str_word_count($request->name) > 1) {
            $category->slug = strtolower(str_replace(' ', '-', $request->name));
        } else {
            $category->slug = strtolower($request->name);
        }

        $category->update();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category) {   
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
