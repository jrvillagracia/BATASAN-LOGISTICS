<?php

namespace App\Models\MaintenanceFacility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityApprove extends Model
{
    use HasFactory;

    protected $table = 'facility_approve';

    protected $primaryKey = 'facilityApproveId';

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
