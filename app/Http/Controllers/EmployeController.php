<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
class EmployeController extends Controller
{

    public function index(){
        return Employe::orderBy('id', 'desc')->get();
    }

    public function store(Request $request){
        return Employe::create($request->all())->fresh();
    }

    public function show($id){
        return Employe::find($id);
    }


    public function update($id, Request $request){
        $employe = Employe::find($id);
        $employe->table_number = $request->table_number;
        $employe->first_name = $request->first_name;
        $employe->last_name = $request->last_name;
        $employe->position_id = $request->position_id;
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