<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $page = $request->input('limit', 5);
        $query = $request->input('q');
        $order = $request->input('ord');
        $sort = $request->input('sort');

        if ($query) {
            $product  = Product::where('name', 'like', '%' . $query . '%')
                                ->orderBy($order, $sort)
                                ->paginate($page);
        } else if ($order) {
            $product = Product::orderBy($order, $sort)->paginate($page);
        }  else {
            $product = Product::All();
        }

        return response()->json(['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id' 
        ]);

        Product::create($validatedData);
        return response()->json([
            'message' => 'Product Created Successfully'
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Product $product)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'numeric|required',
            'stock' => 'numeric|required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id' 
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return response()->json([
            'message' => 'Product Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'message' => 'Product Deleted Successfully'
        ]);
    }
}
