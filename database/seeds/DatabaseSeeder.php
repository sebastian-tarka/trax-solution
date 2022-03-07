<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        \App\User::truncate();
        \App\Car::truncate();
        \App\Trip::truncate();


        factory(App\User::class, 1)->create([
            'email' => 'user@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Qazwsx123')
        ]);
        $this->call(CarSeeder::class);
        $this->call(TripSeeder::class);

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
