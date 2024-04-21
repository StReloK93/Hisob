<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\EmployePosition;
use App\Models\EmployeProduct;
use App\Models\EmployeImages;
use App\Models\Organization;
use DB;
use Carbon\Carbon;



class EmployeController extends Controller
{

    public function index(){
        return Employe::select('id', 'table_number', 'name', 'hiring_date', 'organization_id', 'profession')
        ->with('position')
        ->orderBy('id', 'desc')
        ->accessOrganizations()
        ->get();
    }

    public function store(Request $request){
        $employe = Employe::create($request->all());

        EmployePosition::create([
            'employe_id' => $employe->id,
            'position_id' => $request->position_id,
        ]);
        $employe->position;
        return $employe;
    }

    public function show($id){

        $employe = Employe::with('position')->find($id);
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

        $employe->heigth = $request->heigth;
        $employe->size_cloth = $request->size_cloth;
        $employe->size_head = $request->size_head;
        $employe->size_shoes = $request->size_shoes;
        $employe->save();

        return $employe->fresh();
    }


    public function destroy($id){
        EmployePosition::where('employe_id',$id)->delete();
        EmployeProduct::where('employe_id',$id)->delete();
        EmployeImages::where('employe_id',$id)->delete();
        return Employe::find($id)->delete();
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
        $userData = DB::connection('sqlsrv')->select("SELECT TabelniyNomer , FIO , doljnost , KodPodrazdelenii, Razryad, DataNachaloRaboti  FROM [KADR].[dbo].[PoiskSotrudnikaTabelniyNomer] ($table_number) ");
        if(empty($userData) == false){
            $organization = Organization::where('code', $userData[0]->KodPodrazdelenii)->first();
            return [
                'name' => $userData[0]->FIO,
                'organization_id' => $organization ? $organization->id : null ,
                'profession' => $userData[0]->doljnost ,
                'hiring_date' => Carbon::parse($userData[0]->DataNachaloRaboti)->format('Y-m-d'),
            ];

            
        }
        else{
            return null;
        }
    }

}


