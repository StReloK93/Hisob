<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }


    public function getMainProducts(){
        return Product::where('product_type_id', 2)->get();
    }


    public function store(Request $request){

        $position = Product::create([
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
            'isActive' => $request->isActive,
        ]);

        return $position->fresh();
    }


    public function update($id, Request $request){

        $position = Product::find($id);
        $position->name = $request->name;
        $position->product_type_id = $request->product_type_id;
        $position->isActive = $request->isActive;
        $position->save();

        return $position->fresh();
    }


    public function show($id){
        return Product::find($id);
    }


    public function destroy($id){
        return Product::find($id)->delete();
    }
}