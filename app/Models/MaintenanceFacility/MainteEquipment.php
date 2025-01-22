<?php

namespace App\Models\MaintenanceFacility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainteEquipment extends Model
{
    use HasFactory;

    protected $table = 'mainte_equipment';

    protected $primaryKey = 'mainteEquipmentId';

    protected $fillable = [
        'MainteEquipDate',
        'MainteEquipTime',
        'MainteEquipReqUnit',
        'MainteEquipReqFOR',
        'equipmentStockId'
    ];

    public function equipmentStock()
    {
        return $this->hasOne(EquipmentStock::class, 'equipmentStockId', 'equipmentStockId');
    }

}
