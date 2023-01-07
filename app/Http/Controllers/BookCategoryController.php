<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class BookCategoryController extends Controller
{
    
    public function index()
    {
        return view('category.index', [
            'categories' => category::Paginate(5)
        ]);

    }

    
    public function create()
    {
        return view('category.create');
    }

  
    public function store(StorecategoryRequest $request)
    {
        category::create($request->validated());
        return redirect()->route('categories');
    }

    public function edit(category $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

        public function update(UpdatecategoryRequest $request, $id)
    {
        $category = category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories');
    }

    public function destroy($id)
    {
        category::find($id)->delete();
        return redirect()->route('categories');
    }
}
