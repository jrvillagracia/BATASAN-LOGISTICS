<?php

namespace App\Models\MaintenanceFacility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class MainteFacility extends Model
{
    use HasFactory;

    protected $table = 'mainte_facility';

    protected $primaryKey = 'mainteFacilityId';

    protected $fillable = [
        'RepairId',
        'FacilityBuildingName',
        'FacilityRoom',
        'FacilityType',
        'MainteFacilityReqUnit',
        'MainteFacilityReqFOR',
        'MainteFacilityTime',
        'MainteFacilityDate'
    ];
}
