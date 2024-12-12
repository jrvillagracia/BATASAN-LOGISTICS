<?php

namespace App\Models\Equipments;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $primaryKey = 'equipmentId';

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
        'EquipmentSerialNo',
        'EquipmentStatus'
    ];
}
