<?php

namespace App\Models\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestApprovalSupplies extends Model
{
    use HasFactory;

    protected $table = 'request_approval_supplies'; 

    protected $primaryKey = 'requestApprovalId';

    protected $fillable = [
        'RepairRequestId',
        'ReqSuppDate',
        'ReqSuppTime',
        'ReqSuppliesRequestOffice',
        'ReqSuppBldName',
        'ReqSuppRoom',
        'ReqSupRequestFOR',
        'ReqSupCategoryName',
        'ReqSupType',
        'ReqSupUnit',
        'ReqSupQuantity'
    ];
}
