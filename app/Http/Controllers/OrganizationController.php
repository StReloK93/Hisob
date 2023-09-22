<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function index(){

        return Organization::all();

    }


    public function show($id){

        return Organization::find($id);

    }

    public function store(Request $request){

        return Organization::create([
            'name' => $request->name,
            'code' => $request->code,
            'short_name' => $request->short_name,
            'isActive' => true,
        ]);

    }


    public function update($id, Request $request){
        $position = Organization::find($id);
        $position->name = $request->name;
        $position->code = $request->code;
        $position->short_name = $request->short_name;
        $position->isActive = $request->isActive;
        $position->save();

        return $position;
    }

    public function setActivate($id, Request $request){
        $position = Organization::find($id);
        $position->isActive = $request->active;
        return $position->save();
    }
}
