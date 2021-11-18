<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'          => 'Silver Plan',
            'slug'          => 'silver-plan',
            'stripe_name'   => 'Silver plan',
            'stripe_id'     => 'price_1JxDhpLEqd4hCEb63anpN4Ur',
            'price'         => 119.95,
            'abbreviation'  => 'mo'
        ]);

        Plan::create([
            'name'          => 'Gold Plan',
            'slug'          => 'gold-plan',
            'stripe_name'   => 'Gold plan',
            'stripe_id'     => 'price_1JxDiBLEqd4hCEb6wC6uok7x',
            'price'         => 249.95,
            'abbreviation'  => 'mo'
        ]);

        Plan::create([
            'name'          => 'Platinum Plan',
            'slug'          => 'platinum-plan',
            'stripe_name'   => 'Platinum plan',
            'stripe_id'     => 'price_1JxDiWLEqd4hCEb6WMoYXKfT',
            'price'         => 299.95,
            'abbreviation'  => 'mo'
        ]);
    }
}
