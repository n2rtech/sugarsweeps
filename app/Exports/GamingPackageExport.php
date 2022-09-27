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
                $packages = GamingPackage::get([
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
                ]);
                break;
            case '1':
                $packages = GamingPackage::whereNotNull('user_id')->get([
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
                ]);
                break;
            case '2':
                $packages = GamingPackage::whereNull('user_id')->get([
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
                ]);
                break;
            default:
                $packages = GamingPackage::get([
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
                ]);
                break;
        }

        return $packages;
    }

    public function map($invoice): array
    {
        return [
            $invoice->invoice_number,
            Date::dateTimeToExcel($invoice->created_at),
            $invoice->total
        ];
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
