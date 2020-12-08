<?php

use Illuminate\Database\Seeder;
use App\Models\{Customer, Salesman};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Salesman::class, 3)->create();
        factory(Customer::class, 10)->create();
    }
}
