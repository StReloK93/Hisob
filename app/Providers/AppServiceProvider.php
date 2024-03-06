<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\EmployeProduct;
use App\Models\PositionProduct;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // $collect = collect(PositionProduct::all()->toArray());
        // $products = EmployeProduct::where('expiration_date', null)->get();
        
        // foreach ($products as $key => $value) {
        //     $product = $collect
        //     ->where('position_id', $value->position_id)
        //     ->where('product_id', $value->product_id)
        //     ->first();
        //     if(isset($product)){
        //         $products[$key]->expiration_date = $product['expiration_date'];

        //     }

        //     $value->save();
        // }

        // dd($products[99]);

    }
}



// N_Divisions  = 52 AO NGMK

// T_Firms = Tashkilotlar