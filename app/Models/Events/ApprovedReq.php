<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedReq extends Model
{
    use HasFactory;

    protected $table = 'approved_req';

    protected $fillable = [
        'eventId',
        'EventApprTime',
        'EventApprDate',
        'EventApprRequestOffice',
        'EventApprRequestFor',
        'EventApprName',
        'StartEventApprDate',
        'EndEventApprDate',
        'StartEventApprTime',
        'EndEventApprTime',
        'EventsActBldName',
        'EventsActRoom',
        'EventsActivityInventory',
        'EventActCategoryName',
        'EventActType',
        'EventActUnit',
        'EventActQuantity'
    ];
}
