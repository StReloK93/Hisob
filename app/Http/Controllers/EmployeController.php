<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\EmployePosition;
use App\Models\EmployeProduct;
use App\Models\Organization;
use DB;

class EmployeController extends Controller
{

    public function index(){
        return Employe::orderBy('id', 'desc')->accessOrganizations()->get();
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

        $employe = Employe::find($id);
        $employe->cards = $this->getCardNumbers($employe->table_number);
        return $employe;
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
        
        $employe->table_number = $request->table_number;
        $employe->name = $request->name;
        $employe->profession = $request->profession;
        $employe->hiring_date = $request->hiring_date;
        $employe->gender = $request->gender;
        $employe->organization_id = $request->organization_id;
        $employe->save();

        return $employe->fresh();
    }


    public function getCardNumbers($table_number){
        $cards = DB::connection('sqlsrv')->select("SELECT NomerKarti FROM [SCUD].[dbo].[KartiSotrudnikov] where TabelniyNomer=$table_number and DeletedTime is null");
        $arr = [];

        foreach ($cards as $key => $card) {
            $arr[] = $card->NomerKarti;
        }

        return $arr;
    }


    public function getEmployeData($table_number){
        // $string_version
        // WHERE KodPodrazdelenii IN (".$string_version.")
        $userData = DB::connection('sqlsrv')->select("SELECT TabelniyNomer , FIO , Doljnost , KodPodrazdelenii, Razryad  FROM [KADR].[dbo].[PoiskSotrudnikaTabelniyNomer] ($table_number) ");
        if(empty($userData) == false){
            $organization = Organization::where('code', $userData[0]->KodPodrazdelenii)->first();
            return [
                'name' => $userData[0]->FIO,
                'organization_id' => $organization ? $organization->id : null ,
            ];
        }
        else{
            return null;
        }
    }

}


