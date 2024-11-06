<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteReq extends Model
{
    use HasFactory;

    protected $table = 'complete_req';

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
        'EventApprLocation',
        'EventApprProductName',
        'EventApprQuantity',
    ];
}
