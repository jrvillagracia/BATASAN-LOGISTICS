<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Request\RequestApprovalSupplies;

class ReqApprovalSuppliesController extends Controller
{
    public function index()
    {
        $requestSupplies = RequestApprovalSupplies::all();

        return view ('adminPages.admin_REQapprovalSupplies', compact('requestSupplies'));

    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'ReqSuppDate' => 'required|date_format:Y-m-d',
            'ReqSuppTime' => 'required|date_format:H:i',
            'ReqSuppliesRequestOffice' => 'required|string|max:255',
            'ReqSuppBldName' => 'required|string|max:255',
            'ReqSuppRoom' => 'required|string|max:255',
            'ReqSupRequestFOR' => 'required|string|max:255',
            'ReqSupCategoryName' => 'required|string|max:255',
            'ReqSupType' => 'required|string|max:255',
            'ReqSupUnit' => 'required|string|max:255',
            'ReqSupQuantity' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        // Generate a temporary RepairRequestId
        $tempRepairId = 'TEMP-' . time();

        $requestSupplies = RequestApprovalSupplies::create([
            'ReqSuppDate' => $request->ReqSuppDate,
            'ReqSuppTime' => $request->ReqSuppTime,
            'ReqSuppliesRequestOffice' => $request->ReqSuppliesRequestOffice,
            'ReqSuppBldName' => $request->ReqSuppBldName,
            'ReqSuppRoom' => $request->ReqSuppRoom,
            'ReqSupRequestFOR' => $request->ReqSupRequestFOR,
            'ReqSupCategoryName' => $request->ReqSupCategoryName,
            'ReqSupType' => $request->ReqSupType,
            'ReqSupUnit' => $request->ReqSupUnit,
            'ReqSupQuantity' => $request->ReqSupQuantity,
            'RepairRequestId' => $tempRepairId,
        ]);

        $newRepairId = 'RQS-' . str_pad($requestSupplies->requestApprovalId, 4, '0', STR_PAD_LEFT);

        $requestSupplies->update([
            'RepairRequestId' => $newRepairId,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Request approval supplies created successfully.',
            'data' => $requestSupplies,
        ]);
    }

}
