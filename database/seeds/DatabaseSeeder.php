<?php

use Illuminate\Database\Seeder;
use App\Models\{Customer, Salesman, User};

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

        User::firstOrCreate([
            'name' =>'Admin',
            'email' =>'admin@email.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
