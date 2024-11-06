<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    use HasFactory;

    protected $table = 'supplies';

    protected $fillable = [
        'SuppliesControlNo',
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
        'SuppliesSerialNo'
    ];
}
