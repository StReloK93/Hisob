<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Models\Product;
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
        // $user = DB::connection('1cbase')->select("SELECT * FROM dbo.PoiskSotrudnikaTabelniyNomer ('68595')");

        // dd($user);

        //         $user = DB::connection('oracle')->select("SELECT a.n_gr, a.n_subgr, a.name_subgr, a.creater, a.created, a.changer,
        //         a.changed
        //    FROM nmmc.t_materials_subgr a where a.n_gr=25");

        //         dd($user);

        
    }
}



// N_Divisions  = 52 AO NGMK

// T_Firms = Tashkilotlar