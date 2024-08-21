<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $fillable = [
        'productName',
        'productCategory',
        'productQuantity',
        'productDate',
        'productPrice',
        'productDepartment',
        'productSKU'
    ];
}
