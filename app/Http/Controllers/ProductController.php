<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index (Request $request) {
        $keyword = $request->get('search'); 
        $perpage = 5; 

        if (!empty($keyword)) {
            $products = Product::where('name','like',"%$keyword")
            ->orWhere('category','like',"%$keyword")
            ->latest()->paginate($perpage);
        } else {
            $products = Product::latest()->paginate($perpage); 
        }
        return view('products.index',['products' => $products])->with('i', (request()->input('page', 1) - 1) *5); 
    }

    public function create () {
        return view('products.create');
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'image'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $product=new Product;

        $file_name =time() . ',' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $product->name=$request->name;
        $product->description=$request->description;
        $product->category=$request->category;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->image=$file_name;

        $product->save();
        return redirect()->route('products.index')->With('success','Product Added Successfully'); 

    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',['product'=>$product]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',

        ]);

        $file_name = $request->hidden_product_image;


   if( $request->image != ''){
        $file_name =time() . ',' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);
   }

        $product  = Product::find($request->hidden_id);

        $product->name=$request->name;
        $product->description=$request->description;
        $product->category=$request->category;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->image=$file_name;

        $product->save();
        return redirect()->route('products.index')->With('success','Product Updated Successfully'); 
    }
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Define the image path
        $image_path = public_path('images/' . $product->image);

        // Check if the image file exists and delete it
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        // Delete the product from the database
        $product->delete();

        // Redirect back to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

}
