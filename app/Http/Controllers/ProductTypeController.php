<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    public function index(){
        return ProductType::all();
    }


    // public function show($id){
    //     return Product::find($id);
    // }

    // public function setActivate($id, Request $request){
    //     $position = Product::find($id);
    //     $position->isActive = $request->active;
    //     return $position->save();
    // }
}
