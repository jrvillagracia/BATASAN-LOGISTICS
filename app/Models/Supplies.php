<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    use HasFactory;

    protected $table = 'supplies';

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
