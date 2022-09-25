<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'id' => 1,
            'name' => 'Philip Jonas',
            'email' => 'user@admin.com',
            'phone' => '9999999991',
            'approved' => '2',
            'email_verified_at' => '2021-12-02 00:00:28',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => 'PV4vJ97TJQQtQ4YrDggzPXOxR8idLWcrFVub6Y0dcOq25THLpsZHUIy8stKy',
        ]);

        User::create([
            'id' => 2,
            'name' => 'Tony Mathews',
            'email' => 'user2@admin.com',
            'phone' => '9999999992',
            'approved' => '3',
            'email_verified_at' => '2021-12-02 00:00:28',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => 'PV4vJ97TJQQtQ4YrDggzPXOxR8idLWcrFVub6Y0dcOq25THLpsZHUIy8stKy',
        ]);

        User::create([
            'id' => 3,
            'name' => 'John Doe',
            'email' => 'user3@admin.com',
            'phone' => '9999999993',
            'approved' => '0',
            'email_verified_at' => '2021-12-02 00:00:28',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => 'PV4vJ97TJQQtQ4YrDggzPXOxR8idLWcrFVub6Y0dcOq25THLpsZHUIy8stKy',
        ]);

        User::create([
            'id' => 4,
            'name' => 'Reena Scofield',
            'email' => 'user4@admin.com',
            'phone' => '9999999994',
            'approved' => '1',
            'email_verified_at' => '2021-12-02 00:00:28',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => 'PV4vJ97TJQQtQ4YrDggzPXOxR8idLWcrFVub6Y0dcOq25THLpsZHUIy8stKy',
        ]);
    }
}
