<?php

namespace App\Models\MaintenanceFacility;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
