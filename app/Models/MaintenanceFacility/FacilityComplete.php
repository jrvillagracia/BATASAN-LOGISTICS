<?php

namespace App\Models\MaintenanceFacility;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityComplete extends Model
{
    use HasFactory;

    protected $table = 'facility_complete';

    protected $primaryKey = 'facilityCompleteRequestId';

    protected $fillable = [
        'mainteFacilityId', 
        'RepairId',  
        'MainteFacilityDate',
        'MainteFacilityTime',
        'FacilityBuildingName',
        'FacilityRoom',
        'FacilityType',
        'MainteFacilityReqUnit',
        'MainteFacilityReqFOR',
    ];

    public function mainteFacility()
    {
        return $this->belongsTo(MainteFacility::class, 'mainteFacilityId', 'mainteFacilityId');
    }
}
