<?php

namespace Database\Seeders;

use App\Models\GamingAccount;
use Illuminate\Database\Seeder;

class GamingAccountSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GamingAccount::create( [
            'id'=>1,
            'user_id'=>1,
            'platform_id'=>1,
            'status'=>1,
            'username'=>'905800',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );



            GamingAccount::create( [
            'id'=>2,
            'user_id'=>1,
            'platform_id'=>2,
            'status'=>1,
            'username'=>'adeptness',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );



            GamingAccount::create( [
            'id'=>3,
            'user_id'=>1,
            'platform_id'=>3,
            'status'=>1,
            'username'=>'56-55-98-73-25-81',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );



            GamingAccount::create( [
            'id'=>4,
            'user_id'=>1,
            'platform_id'=>4,
            'status'=>1,
            'username'=>'adeptness',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );



            GamingAccount::create( [
            'id'=>5,
            'user_id'=>1,
            'platform_id'=>5,
            'status'=>1,
            'username'=>'adeptness',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );



            GamingAccount::create( [
            'id'=>6,
            'user_id'=>1,
            'platform_id'=>6,
            'status'=>1,
            'username'=>'adeptness',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );



            GamingAccount::create( [
            'id'=>7,
            'user_id'=>1,
            'platform_id'=>7,
            'status'=>1,
            'username'=>'0186476275',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );



            GamingAccount::create( [
            'id'=>8,
            'user_id'=>1,
            'platform_id'=>8,
            'status'=>1,
            'username'=>'adeptness',
            'password'=>'Abc123',
            'cashier_id'=>NULL,
            'action_taken_at'=>'2022-09-27 12:45:52',
            'created_at'=>'2022-09-27 07:15:52',
            'updated_at'=>'2022-09-27 07:15:52'
            ] );
    }
}
