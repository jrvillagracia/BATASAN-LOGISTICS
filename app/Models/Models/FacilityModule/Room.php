<?php

namespace App\Models\Models\FacilityModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'room';
    
    protected $fillable = [
        'BldNAme',
        'Room',
        'facilityShift',
        'facilityStatus',
        'Capacity',
        'facilityRoomType',
        'facilityRoomDate',
    ];
}
