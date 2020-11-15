<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'password' => '12345678',
            'email' => 'johndoe@exaple.com',
            'confirmed' => 1
        ]);
    }
}
