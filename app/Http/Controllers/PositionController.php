<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\PositionProduct;
use DB;
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
            'main_document_id' => $request->main_document_id,
            'number_in_document' => $request->number_in_document,
            'position_type_id' => $request->position_type_id,
            'isActive' => $request->isActive,
        ]);

        foreach ($request->products as $key => $product) {
            PositionProduct::create([
                'position_id' => $position->id,
                'product_id' => $product['id'],
                'count' => $product['count'],
                'expiration_date' => $product['expiration_date'],
                'working_condition_id' => $product['working_condition_id'],
            ]);
        }


        return $position->fresh();
    }


    public function update($id, Request $request){
        $position = Position::find($id);
        $position->name = $request->name;
        $position->main_document_id = $request->main_document_id;
        $position->number_in_document = $request->number_in_document;
        $position->position_type_id = $request->position_type_id;
        $position->isActive = $request->isActive;
        $position->save();

        PositionProduct::where('position_id', $id)->delete();

        foreach ($request->products as $key => $product) {
            PositionProduct::create([
                'position_id' => $position->id,
                'product_id' => $product['id'],
                'count' => $product['count'],
                'expiration_date' => $product['expiration_date'],
                'working_condition_id' => $product['working_condition_id'],
            ]);
        }

        return $position->fresh();
    }


    public function setActivate($id, Request $request){
        $position = Position::find($id);
        $position->isActive = $request->active;
        return $position->save();
    }


    public function destroy($id){
        PositionProduct::where('position_id', $id)->delete();

        return Position::find($id)->delete();
    }
}


// public function allPositions(){
//     return DB::connection('sqlsrv')->select("SELECT distinct doljnost FROM [KADR].[dbo].[sprSotrudniki]");
// }