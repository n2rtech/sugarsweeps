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
            'platform' => 'Gemini',
            'download_link' => 'https://betsoft.com/games/gemini-joker',
            'status' => 1,
            'image' => 'gemini.png',
            'created_at' => '2022-02-09 19:08:40',
            'updated_at' => '2022-02-16 20:14:15'
        ]);

        GamingPlatform::create([
            'id' => 2,
            'platform' => 'Orion Stars',
            'download_link' => 'http://orionstars.vip:8580/index.html',
            'status' => 1,
            'image' => 'orion-stars.png',
            'created_at' => '2022-02-09 19:08:40',
            'updated_at' => '2022-02-16 20:14:15'
        ]);

        GamingPlatform::create([
            'id' => 3,
            'platform' => 'River Sweeps',
            'download_link' => 'https://bet777.eu/play/',
            'status' => 1,
            'image' => 'river-sweeps.png',
            'created_at' => '2022-02-09 19:09:15',
            'updated_at' => '2022-02-16 20:12:22'
        ]);

        GamingPlatform::create([
            'id' => 4,
            'platform' => 'V Power',
            'download_link' => 'https://vpowerusa.com/download.html',
            'status' => 1,
            'image' => 'v-power.png',
            'created_at' => '2022-02-09 19:09:15',
            'updated_at' => '2022-02-16 20:12:22'
        ]);

        GamingPlatform::create([
            'id' => 5,
            'platform' => 'Ultramonster',
            'download_link' => 'https://www.ultramonster.net',
            'image' => 'ultra-monster.png',
            'status' => 1,
            'created_at' => '2022-02-09 19:08:55',
            'updated_at' => '2022-02-09 19:08:55'
        ]);

        GamingPlatform::create([
            'id' => 6,
            'platform' => 'Firekirin',
            'download_link' => 'http://firekirin.xyz:8580/index.html',
            'status' => 1,
            'image' => 'fire-kirin.png',
            'created_at' => '2022-02-09 19:08:40',
            'updated_at' => '2022-02-16 20:14:15'
        ]);

        GamingPlatform::create([
            'id' => 7,
            'platform' => 'Blue Dragons',
            'download_link' => 'https://bluedragonslots.com/',
            'status' => 1,
            'image' => 'blue-dragon.png',
            'created_at' => '2022-02-16 20:15:46',
            'updated_at' => '2022-02-16 20:15:46'
        ]);

        GamingPlatform::create([
            'id' => 8,
            'platform' => 'Panda Master',
            'download_link' => 'https://pandamaster.com/',
            'status' => 1,
            'image' => 'panda-master.png',
            'created_at' => '2022-02-16 20:15:46',
            'updated_at' => '2022-02-16 20:15:46'
        ]);







    }
}
