<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employe;
use App\Models\Position;
use App\Models\Organization;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Employe::class;

    public function definition()
    {
        return [
            'table_number' => rand(10000,99999),
            'name' => fake()->name(),
            'profession' => fake()->name(),
            'hiring_date' => fake()->dateTimeThisYear(),
            'gender' => (bool)rand(0,1),
            'organization_id' => Organization::inRandomOrder()->first(),
            'division_id' => 1,
        ];
    }
}
