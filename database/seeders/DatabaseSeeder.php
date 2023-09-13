<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Employe;
use App\Models\Position;
use App\Models\Organization;
use App\Models\Product;
use App\Models\ProductType;
Use Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Soliyev Aziz',
            'login' => 'admin',
            'password' => Hash::make('zzzz1111*'),
            'name' => 'Soliyev Aziz',
        ]);


        Organization::factory(4)->state(new Sequence(
            [
                'name' => 'Axborot kommunikatsion texnologiyalar markazi',
                'short_name' => 'AKTM',
            ],
            [
                'name' => 'Shimoliy kon boshqarmasi',
                'short_name' => 'SHKB',
            ],
            [
                'name' => 'Gidro-metallurgiya zavodi 3',
                'short_name' => 'GMZ-3',
            ],
            [
                'name' => "Temir yo'l sexi",
                'short_name' => 'TYS',
            ],
        ))->create();

        Position::factory(4)->state(new Sequence(
            [
                'name' => 'Muhandis dasturchi',
            ],
            [
                'name' => 'Nonvoy',
            ],
            [
                'name' => 'Duradgor',
            ],
            [
                'name' => 'Mexanik',
            ],
        ))->create();


        Employe::factory(10)->create();


        Product::factory(4)->state(new Sequence(
            [
                'name' => 'Kurtka',
                'product_type_id' => 1,
                'expiration_date' => 12,
            ],
            [
                'name' => 'Shim',
                'product_type_id' => 1,
                'expiration_date' => 6,
            ],
            [
                'name' => "Qo'lqop",
                'product_type_id' => 1,
                'expiration_date' => 18,
            ],
            [
                'name' => 'Oyoq Kiyim',
                'product_type_id' => 1,
                'expiration_date' => 24,
            ],
        ))->create();


        ProductType::insert([
            ['name' => 'Ximoya vositalari'],
            ['name' => 'Asosiy vositalar'],
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
