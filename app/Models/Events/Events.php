<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $table = 'events';

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
        'EventApprQuantity'
    ];
}
