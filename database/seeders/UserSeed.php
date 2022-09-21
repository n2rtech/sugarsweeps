<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Alex',
            'lastname' => 'Mahon',
            'phone' => '9293192931',
            'email' => 'user@admin.com',
            'password' => Hash::make('password')

        ]);
    }
}
