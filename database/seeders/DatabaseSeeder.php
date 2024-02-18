<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReportType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ReportType::insert([
        //     ['name' => 'Oylik hisobot'],
        //     ['name' => 'ММваХТ hisobot'],
        // ]);


        $this->call([
            // MainSeeder::class,
            // TestSeeder::class,
        ]);

    }
}
