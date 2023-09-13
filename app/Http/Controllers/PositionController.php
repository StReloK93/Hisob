<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\PositionProduct;
class PositionController extends Controller
{
    public function index(){
        return Position::all();
    }


    public function show($id){
        return Position::find($id);
    }


    public function store(Request $request){

        $position = Position::create([
            'name' => $request->name,
            'isActive' => $request->isActive,
        ]);

        foreach ($request->products as $key => $product) {
            PositionProduct::create([
                'position_id' => $position->id,
                'product_id' => $product['id'],
                'count' => $product['count'],
            ]);
        }


        return $position->fresh();
    }


    public function update($id, Request $request){
        $position = Position::find($id);
        $position->name = $request->name;
        $position->isActive = $request->isActive;
        $position->save();

        PositionProduct::where('position_id', $id)->delete();

        foreach ($request->products as $key => $product) {
            PositionProduct::create([
                'position_id' => $position->id,
                'product_id' => $product['id'],
                'count' => $product['count'],
            ]);
        }

        return $position->fresh();
    }


    public function setActivate($id, Request $request){
        $position = Position::find($id);
        $position->isActive = $request->active;
        return $position->save();
    }
}
