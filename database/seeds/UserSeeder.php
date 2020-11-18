<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'JohnDoe',
            'password' => Hash::make('12345678'),
            'email' => 'johndoe@example.com',
            'confirmed' => 1
        ]);
    }
}
