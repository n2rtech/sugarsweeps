<?php

namespace Database\Seeders;

use App\Models\GamingPlatform;
use Illuminate\Database\Seeder;

class GamingPlatformSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GamingPlatform::create([
            'id' => 1,
            'platform' => 'Firekirin',
            'download_link' => 'http://firekirin.xyz:8580/index.html',
            'status' => 1,
            'image' => 'fire-kirin.png',
            'created_at' => '2022-02-09 19:08:40',
            'updated_at' => '2022-02-16 20:14:15'
        ]);

        GamingPlatform::create([
            'id' => 2,
            'platform' => 'Golden Dragons',
            'download_link' => 'https://goldendragons.com/',
            'status' => 1,
            'image' => 'golden-dragon.png',
            'created_at' => '2022-02-16 20:15:46',
            'updated_at' => '2022-02-16 20:15:46'
        ]);

        GamingPlatform::create([
            'id' => 3,
            'platform' => 'Ultramonster',
            'download_link' => 'https://www.ultramonster.net',
            'image' => 'ultra-monster.png',
            'status' => 1,
            'created_at' => '2022-02-09 19:08:55',
            'updated_at' => '2022-02-09 19:08:55'
        ]);

        GamingPlatform::create([
            'id' => 4,
            'platform' => 'River Sweeps',
            'download_link' => 'https://bet777.eu/play/',
            'status' => 1,
            'image' => 'river-sweeps.png',
            'created_at' => '2022-02-09 19:09:15',
            'updated_at' => '2022-02-16 20:12:22'
        ]);



    }
}
