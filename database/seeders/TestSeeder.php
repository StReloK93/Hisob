<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

use App\Models\User;
use App\Models\Role;
use App\Models\Employe;
use App\Models\Position;
use App\Models\PositionProduct;
use App\Models\EmployePosition;
use App\Models\Product;
Use Hash;
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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

        User::create([
            'name' => 'Soliyev Aziz',
            'login' => 'admin',
            'password' => Hash::make('zzzz1111*'),
            'name' => 'Soliyev Aziz',
        ]);

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

        EmployePosition::insert([
            ['employe_id' => 1,'position_id' => 2, 'created_at' => now()],
            ['employe_id' => 2,'position_id' => 1, 'created_at' => now()],
            ['employe_id' => 3,'position_id' => 3, 'created_at' => now()],
        ]);


        Role::insert([
            [ 'name' => 'Admin' ],
            [ 'name' => 'Omborchi' ],
            [ 'name' => 'Buxgalter' ],
            [ 'name' => 'TB' ],
        ]);


        Employe::factory(10)->create();



        PositionProduct::insert([
            [ 'position_id' => 1,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 1,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 1,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 2,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 2,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 2,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 3,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 3,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
            [ 'position_id' => 3,'product_id' => Product::inRandomOrder()->first()->id, 'count' => 1, 'created_at' => now() ],
        ]);
    }
}
