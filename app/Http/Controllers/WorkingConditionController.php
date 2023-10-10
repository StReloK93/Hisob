<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingCondition;



class WorkingConditionController extends Controller
{
    public function index(){

        return WorkingCondition::all();

    }


    public function show($id){

        return WorkingCondition::find($id);

    }

    public function store(Request $request){

        $workingCondition = new WorkingCondition();
        $workingCondition->name = $request->name;
        $workingCondition->save();

        return $workingCondition;

    }


    public function update($id, Request $request){

        $workingCondition = WorkingCondition::find($id);
        $workingCondition->name = $request->name;
        $workingCondition->save();

        return $workingCondition;

    }
}
