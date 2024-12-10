<?php

namespace App\Models\Supplies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliesStock extends Model
{
    use HasFactory;

    protected $table = 'supplies_stock';

    protected $primaryKey = 'suppliesStockId';

    protected $fillable = [
        'SuppliesBrandName',
        'SuppliesName',
        'SuppliesCategory',
        'SuppliesType',
        'SuppliesColor',
        'SuppliesUnit',
        'SuppliesQuantity',
        'SuppliesDate',
        'SuppliesUnitPrice',
        'SuppliesDepartment',
        'SuppliesClassification',
        'SuppliesSKU',
    ];
}
