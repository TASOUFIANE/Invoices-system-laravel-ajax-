<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $sections=Section::all();
        return view('products.index', compact('products','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'desc'=>'nullable|string',
            'section_id'=>'required|exists:sections,id',
        ]);
        Product::create([
            'name'=>$data['name'],
            'description'=>$data['desc'],
            'section_id'=>$data['section_id'],
        ]);
        return redirect()->back()->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'desc'=>'nullable|string',
            'section_id'=>'required|exists:sections,id',
        ]);

        Product::where('id',$request->id)->update([
            'name'=>$data['name'],
            'description'=>$data['desc'],
            'section_id'=>$data['section_id'],
        ]);
        return redirect()->back()->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $product)
    {
        //
        Product::where('id',$product->id)->delete();
        return redirect()->back()->with('success','Product deleted successfully');
    }
}
