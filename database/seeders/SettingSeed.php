<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create( [
            'id'=>1,
            'type'=>'cashapp',
            'value'=>["cashapp" => "https://cash.app/username/"],
            'created_at'=>'2022-08-21 02:30:49',
            'updated_at'=>'2022-08-21 02:30:49'
            ] );

            Setting::create( [
            'id'=>2,
            'type'=>'privacy-policy',
            'value'=> ["content" => "Privacy Policy Page Content will be managed in Admin > Settings > Privacy Policy"],
            'created_at'=>'2022-08-21 02:30:49',
            'updated_at'=>'2022-08-21 02:30:49'
            ] );

            Setting::create( [
            'id'=>3,
            'type'=>'terms-and-conditions',
            'value'=> ["content" => "Terms & Conditions Page Content  will be managed in Admin > Settings > Terms"],
            'created_at'=>'2022-08-21 02:30:49',
            'updated_at'=>'2022-08-21 02:30:49'
            ] );

    }
}
