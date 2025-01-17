<?php

namespace App\Models\Equipments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentStock extends Model
{
    use HasFactory;

    protected $table = 'equipment_stocks';

    protected $primaryKey = 'equipmentStockId';

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

    public function mainteEquipment()
    {
        return $this->belongsTo(MainteEquipment::class, 'mainteEquipmentId');
    }
}
