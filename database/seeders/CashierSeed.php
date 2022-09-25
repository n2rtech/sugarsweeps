<?php

namespace Database\Seeders;

use App\Models\Cashier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CashierSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cashier::create([
            'name' => 'Lincon Thomas',
            'phone' => '9854786582',
            'email' => 'cashier@admin.com',
            'password' => Hash::make('password')

        ]);
    }
}
