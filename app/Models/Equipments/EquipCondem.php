<?php

namespace App\Models\Equipments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipCondem extends Model
{
    use HasFactory;

    protected $table = 'equipcondem';

    protected $primaryKey = 'equipcondemId';

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
