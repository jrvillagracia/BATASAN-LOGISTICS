<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Equipments\EquipmentStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EquipmentExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    public function collection()
    {
        // Get the equipment data with grouping and sum for quantity
        return EquipmentStock::select(
                'EquipmentBrandName',
                'EquipmentName',
                'EquipmentCategory',
                'EquipmentSKU',
                DB::raw('SUM(COALESCE("EquipmentQuantity", 0)) AS "EquipmentQuantity"'),
                DB::raw('SUM(COALESCE("EquipmentUnitPrice", 0) * COALESCE("EquipmentQuantity", 0)) AS "totalPrice"')
            )
            ->groupBy(
                'EquipmentBrandName',
                'EquipmentName',
                'EquipmentCategory',
                'EquipmentSKU'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Brand Name',
            'Equipment Name',
            'Category',
            'SKU',
            'Total Quantity', // Equipment quantity after sum
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

