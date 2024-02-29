<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeProduct;
use App\Models\PositionProduct;
use DB;
class EmployeProductController extends Controller
{
    public function index(){
        $employeProduct = EmployeProduct::with('employe')->accessOrganizations()->get();
        return $employeProduct->filter(function ($product, $key) {
            return $product->timer < 400;
        })->values();
    }

    public function show($id){
        return EmployeProduct::find($id);
    }

    public function getEmployeProducts($employe_id){
        
        $employeProducts = EmployeProduct::where('employe_id', $employe_id)->with('report')->get();
        foreach ($employeProducts as $key => $empProduct) {
            $employeProducts[$key]->product_data = PositionProduct::without('product')->where([
                ['position_id', $empProduct->position_id],
                ['product_id', $empProduct->product_id],
            ])->first();
        }


        return $employeProducts;
    }

    public function getMainEmployeProducts($employe_id){
        // return EmployeProduct::where('employe_id', $employe_id)->MainProducts()->get();
        return EmployeProduct::where('employe_id', $employe_id)->get();
    }

    public function store(Request $request){
        $products = [];
        foreach ($request->products as $key => $product) {
            $product = EmployeProduct::create([
                'employe_id' => $request->employe_id,
                'product_id' => $product['product_id'],
                'position_id' => $product['position_id'],
                'count' => $product['count'],
                'nomenclature' => $product['nomenclature'],
                'price' => $product['price'],
                'date_of_receipt' => $product['date_of_receipt'],
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

    
    public function destroy($id){
        return EmployeProduct::find($id)->delete();
    }


}
