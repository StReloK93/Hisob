<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }


    public function store(Request $request){

        $position = Product::create([
            'name' => $request->name,
            'expiration_date' => $request->expiration_date,
            'product_type_id' => $request->product_type,
            'isActive' => $request->isActive,
        ]);

        return $position->fresh();
    }


    public function update($id, Request $request){

        $position = Product::find($id);
        $position->name = $request->name;
        $position->expiration_date = $request->expiration_date;
        $position->product_type_id = $request->product_type;
        $position->isActive = $request->isActive;
        $position->save();

        return $position->fresh();
    }


    public function show($id){
        return Product::find($id);
    }

    public function setActivate($id, Request $request){
        $position = Product::find($id);
        $position->isActive = $request->active;
        return $position->save();
    }
}


        // return Product::where([
        //     ['n_gr', 25],
        //     ['complete', 'Y']
        // ])->get();