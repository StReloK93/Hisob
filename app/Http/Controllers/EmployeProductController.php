<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeProduct;
use DB;
class EmployeProductController extends Controller
{
    public function index(){
        return EmployeProduct::all();
    }


    public function show($id){
        return EmployeProduct::find($id);
    }

    public function getEmployeProducts($employe_id){
        return EmployeProduct::where('employe_id', $employe_id)->SpecialProducts()->get();
    }

    public function store(Request $request){
        $products = [];
        foreach ($request->products as $key => $product) {
            $product = EmployeProduct::create([
                'employe_id' => $request->employe_id,
                'product_id' => $product['id'],
                'count' => $product['count'],
                'nomenclature' => $product['nomenclature'],
                'price' => $product['price'],
                'date_of_receipt' => $request->date_of_receipt,
            ]);

            $products[] = $product->fresh();
        }

        return $products;

    }




    // public function update($id, Request $request){

    //     $employePosition = EmployePosition::where('employe_id' , $id)->latest('id')->first();

    //     if($employePosition){
    //         $employePosition->position_id = $request->position_id;
    //         $employePosition->save();
    //     }
    //     else{
    //         EmployePosition::create([
    //             'employe_id' => $id,
    //             'position_id' => $request->position_id,
    //         ]);
    //     }

    //     $employe = Employe::find($id);
        
    //     $employe->table_number = $request->table_number;
    //     $employe->name = $request->name;
    //     $employe->hiring_date = $request->hiring_date;
    //     $employe->gender = $request->gender;
    //     $employe->organization_id = $request->organization_id;
    //     $employe->save();

    //     return $employe->fresh();
    // }





    public function getProductPrices($nomenclature){

        return DB::connection('oracle')->select("SELECT DISTINCT a.N, a.name, a.price1, a.measure FROM nmmc.v_rests_bso a WHERE a.N=$nomenclature AND a.in_balance='Y'");
        // 2515075
    }


    public function confirmProduct(Request $request){

        return EmployeProduct::whereIn('id', $request->all())->update([
            'toggle_confirmation' => true,
        ]);

    }

    
}
