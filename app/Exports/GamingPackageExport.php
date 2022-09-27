<?php

namespace App\Exports;

use App\Models\GamingPackage;
use Facade\Ignition\Support\Packagist\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GamingPackageExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }


    public function collection()
    {

        switch ($this->data['type']) {

            case '0':
                $packages = GamingPackage::get();
                break;
            case '1':
                $packages = GamingPackage::whereNotNull('user_id')->get();
                break;
            case '2':
                $packages = GamingPackage::whereNull('user_id')->get();
                break;
            default:
                $packages = GamingPackage::get();
                break;
        }

        return $packages;
    }

    public function headings(): array
    {
        return [
            'package',
            'gemini',
            'orionstars',
            'riversweeps',
            'vpower',
            'ultramonster',
            'firekirin',
            'bluedragons',
            'pandamaster',
            'password'
        ];
    }
}
