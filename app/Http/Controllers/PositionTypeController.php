<?php

namespace App\Http\Controllers;

use App\Models\PositionType;
use Illuminate\Http\Request;

class PositionTypeController extends Controller
{

    public function index()
    {
        return PositionType::all();
    }


    public function store(Request $request)
    {
        return PositionType::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
    }


    public function show($id)
    {
        return PositionType::find($id);
    }


    public function update(Request $request, $id)
    {
        $PositionType =  PositionType::find($id);
        $PositionType->name = $request->name;
        $PositionType->code = $request->code;
        $PositionType->save();

        return $PositionType;
    }

    
    public function destroy(PositionType $PositionType)
    {
        return PositionType::find($id)->delete();
    }
}
