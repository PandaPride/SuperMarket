<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $page = $request->input('limit', 5);
        $query = $request->input('q');

        if ($query) {
            $brand  = Category::where('name', 'like', '%' . $query . '%')->paginate($page);
        } else {
            $brand = Category::All();
        }

        return response()->json(['product' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        Category::create($validatedData);
        return response()->json([
            'message' => 'Category Created Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);
        return response()->json([
            'message' => 'Category Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category Deleted Successfully'
        ]);
    }
}
