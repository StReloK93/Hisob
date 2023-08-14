<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
class EmployeController extends Controller
{

    public function index(){
        return Employe::all();
    }

    public function store(Request $request){
        return Employe::create($request->all());
    }


    public function show($id){
        return Employe::find($id);
    }

    public function getEmployeWithTable(){
        $user = DB::connection('1cbase')->select("SELECT TabelniyNomer , FIO , Doljnost , KodPodrazdelenii, Razryad  FROM dbo.PoiskSotrudnikaTabelniyNomer ('".$request->tableNumber."') WHERE KodPodrazdelenii IN (".$string_version.")");
    }
}
