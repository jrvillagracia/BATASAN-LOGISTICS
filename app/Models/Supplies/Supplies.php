<?php

namespace App\Models\Supplies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplies extends Model
{
    use HasFactory;

    protected $table = 'supplies';

    protected $primaryKey = 'suppliesId';

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
