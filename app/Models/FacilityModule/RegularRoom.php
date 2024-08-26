<?php

namespace App\Models\FacilityModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegularRoom extends Model
{
    use HasFactory;

    protected $table ='reg_room';

    protected $fillable = [
        'RegBuildingName',
        'RegRoomNumber',
        'Shift',
        'Status',
        'RegCapacity',
    ];
    
}
