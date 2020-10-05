<?php 

namespace App\Excel\Download;

use App\Invoice;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersDetailsPreFormatExcel implements WithHeadings, WithMappedCells, ShouldAutoSize
{
    use Exportable;

    public function headings() : array {

        return [

            '#',
            'NAME',
            'NUMBER',
            'EMAIL ADDRESS'

        ];
    }

    public function mapping() : array {

            return [
                'Batch Number' => 'A2',
            ];
    }

    
}

