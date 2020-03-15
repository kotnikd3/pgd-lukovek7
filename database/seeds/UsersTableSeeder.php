<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Denis',
            'surname' =>'Kotnik',
            'email' => 'denis.kotnik@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'remember_token' => Str::random(10)
        ]);

        factory(User::class, 9)->create(); // Ustvarimo nekaj uporabnikov in jih shranimo v podatkovno bazo.
    }
}
