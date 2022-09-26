<?php

namespace Database\Seeders;

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
        $this->call(UserSeed::class);
        $this->call(AdminSeed::class);
        $this->call(CashierSeed::class);
        $this->call(GamingPlatformSeed::class);
        $this->call(PaymentMethodSeed::class);
        $this->call(SettingSeed::class);
    }

}
