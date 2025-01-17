<?php

namespace App\Exports;

use App\Models\SuppliesStock;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class SuppliesExport implements FromCollection,WithHeadings,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SuppliesStock::select(
            'SuppliesBrandName',
            'SuppliesName',
            'SuppliesCategory',
            'SuppliesSKU',
            DB::raw('SUM(COALESCE("SuppliesQuantity", 0)) AS "SuppliesQuantity"'),
            DB::raw('SUM(COALESCE("SuppliesUnitPrice", 0) * COALESCE("SuppliesQuantity", 0)) AS "totalPrice"')
        )
        
        ->groupBy(
            'SuppliesBrandName',
            'SuppliesName',
            'SuppliesCategory',
            'SuppliesSKU'
        )
        ->get();
    }

    public function headings(): array
    {
        return [
            'Brand Name',
            'Supplies Name',
            'Category',
            'SKU',
            'Total Quantity', // Supplies quantity after sum
            'Total Price',
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,  // Quantity
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,  // Total Price
        ];
    }
}
