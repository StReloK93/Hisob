<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductType;


class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ProductType::insert([
            ['name' => 'Ximoya vositalari'],
            ['name' => 'Asosiy vositalar'],
        ]);
        
    }
}
