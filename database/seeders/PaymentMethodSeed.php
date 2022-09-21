<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'method' => 'Cryptocurrency',
            'status' => 1,

        ]);

        PaymentMethod::create([
            'method' => 'Cash App',
            'status' => 1,

        ]);

        // PaymentMethod::create([
        //     'method' => 'Venemo',
        //     'status' => 1,

        // ]);

        // PaymentMethod::create([
        //     'method' => 'Paypal',
        //     'status' => 1,

        // ]);
    }
}
