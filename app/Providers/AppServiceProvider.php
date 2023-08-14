<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
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
        // $user = DB::connection('1cbase')->select("SELECT TabelniyNomer , FIO , Doljnost , KodPodrazdelenii, Razryad  FROM dbo.PoiskSotrudnikaTabelniyNomer ('68595')");


        // dd($user);
    }
}
