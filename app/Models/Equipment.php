<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $fillable = [
        'EquipmentControlNo',
        'EquipmentBrandName',
        'EquipmentName',
        'EquipmentCategory',
        'EquipmentType',
        'EquipmentColor',
        'EquipmentUnit',
        'EquipmentQuantity',
        'EquipmentDate',
        'EquipmentUnitPrice',
        'EquipmentDepartment',
        'EquipmentClassification',
        'EquipmentSKU',
        'EquipmentSerialNo'
    ];
}
