<?php

namespace App\Imports;

use App\Models\GamingPackage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GamingPackageImport implements ToCollection, WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){

            GamingPackage::create([

                'package'       => $row['package'],
                'gemini'        => $row['gemini'],
                'orionstars'    => $row['orionstars'],
                'riversweeps'   => $row['riversweeps'],
                'vpower'        => $row['vpower'],
                'ultramonster'  => $row['ultramonster'],
                'firekirin'     => $row['firekirin'],
                'bluedragons'   => $row['bluedragons'],
                'pandamaster'   => $row['pandamaster'],
                'password'      => array_key_exists('password', $row) ? $row['password'] : 'Abc123',
                'user_id'       => array_key_exists('user_id', $row) ? $row['user_id'] : null,
                'status'        => '0',

            ]);
        }
    }
}
