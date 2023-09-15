<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\EmployePosition;
class EmployeController extends Controller
{

    public function index(){
        return Employe::orderBy('id', 'desc')->get();
    }

    public function store(Request $request){
        $employe = Employe::create($request->all());

        EmployePosition::create([
            'employe_id' => $employe->id,
            'position_id' => $request->position_id,
        ]);

        return $employe->fresh();

    }

    public function show($id){
        return Employe::find($id);
    }


    public function update($id, Request $request){

        $employePosition = EmployePosition::where('employe_id' , $id)->latest('id')->first();

        if($employePosition){
            $employePosition->position_id = $request->position_id;
            $employePosition->save();
        }
        else{
            EmployePosition::create([
                'employe_id' => $id,
                'position_id' => $request->position_id,
            ]);
        }

        $employe = Employe::find($id);
        $employe->name = $request->name;
        $employe->hiring_date = $request->hiring_date;
        $employe->gender = $request->gender;
        $employe->organization_id = $request->organization_id;
        $employe->save();

        return $employe->fresh();
    }

}


// public function getEmployeWithTable(){
//     $user = DB::connection('1cbase')->select("SELECT TabelniyNomer , FIO , Doljnost , KodPodrazdelenii, Razryad  FROM dbo.PoiskSotrudnikaTabelniyNomer ('".$request->tableNumber."') WHERE KodPodrazdelenii IN (".$string_version.")");
// }