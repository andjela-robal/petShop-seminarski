<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth',['except'=>['index','show','procat']]);
     }
     
    public function index()
    {
        $product = Product::orderBy('created_at','asc')->paginate(10);
        return view('products.index')->with('products', $product);
    }

    public function procat(Request $request)
    {
        $category = $request->category;
        $product = Product::where('category',$category)->paginate(10);
        return view('products.index')->with('products', $product);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'category_id' => 'required',
        'cover_image' => 'image|nullable|max:1999'
    ]);

    // Handle File Upload
    if ($request->hasFile('cover_image')) {
        // Get filename with the extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    } else if ($request->input('cover_image')) {
        $fileNameToStore = $request->input('cover_image'); // Use manually provided image name
    } else {
        $fileNameToStore = 'noimage.jpg';
    }

    // Create Product
    $product = new Product;
    $product->category_id = $request->input('category_id'); // Ensure you use the correct field name
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->description = $request->input('description');
    $product->stock = $request->input('stock');
    $product->user_id = auth()->user()->id;
    $product->cover_image = $fileNameToStore;
    $product->save();

    return redirect('/products')->with('success', 'New Product Added!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
    
        return view('products.show')->with('products', $product); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // Find the product by slug
        $product = Product::where('slug', $slug)->first();
        $categories = Category::all()->pluck('name', 'id');
    
        // Check if product exists before editing
        if (!$product) {
            return redirect('/products')->with('error', 'No Product Found');
        }
    
        // Check for correct user
        if (auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Unauthorized Page');
        }
    
        return view('products.edit')->with(['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
{
    $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'category_id' => 'required',
        'cover_image' => 'image|nullable|max:1999'
    ]);

    // Handle File Upload
    if ($request->hasFile('cover_image')) {
        // Get filename with the extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    } else {
        $fileNameToStore = $request->input('cover_image'); // Use manually provided image name
    }

    // Find the product by slug
    $product = Product::where('slug', $slug)->first();
    if (!$product) {
        return redirect('/products')->with('error', 'Product not found');
    }

    // Update product details
    $product->category_id = $request->input('category_id');
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->stock = $request->input('stock');
    $product->user_id = auth()->user()->id;
    if ($request->hasFile('cover_image')) {
        $product->cover_image = $fileNameToStore;
    }
    $product->save();

    return redirect('/products')->with('success', 'Product updated successfully');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    
    // Check if product exists before deleting
    if (!$product) {
        return redirect('/products')->with('error', 'Product not found');
    }

    // Check for correct user
    if (auth()->user()->id !== $product->user_id) {
        return redirect('/products')->with('error', 'Unauthorized Page');
    }

    // Delete product and handle image deletion if necessary
    if ($product->cover_image != 'noimage.jpg') {
        Storage::delete('public/cover_images/' . $product->cover_image);
    }
    
    $product->delete();
    return redirect('/products')->with('success', 'Product removed successfully');
}
}

