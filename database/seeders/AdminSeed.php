<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'firstname' => 'Sara',
            'lastname' => 'Trancedi',
            'phone' => '9229692296',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')

        ]);
    }
}
