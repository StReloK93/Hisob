<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

use App\Models\Employe;

use App\Models\PositionProduct;
use App\Models\EmployePosition;
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employe::factory(10)->create();

        EmployePosition::insert([
            ['employe_id' => 1,'position_id' => 2, 'created_at' => now()],
            ['employe_id' => 2,'position_id' => 1, 'created_at' => now()],
            ['employe_id' => 3,'position_id' => 3, 'created_at' => now()],
        ]);


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
