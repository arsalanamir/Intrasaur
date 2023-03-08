<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function allComplaints()
    {
        $allComplaints = Complaint::with('userData', 'orgData')->get();
        return [
            'data' => $allComplaints,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function openComplain($id)
    {
        $comp = Complaint::find($id)->update([
            'status' => 1,
        ]);
        return [
            'data' => $comp,
            'status' => 200,
            'message' => 'Status updated',
        ];
    }
    public function addComplaint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'org_id' => 'required',
            'issue' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $comp = Complaint::create([
            'org_id' => $request->org_id,
            'issue' => $request->issue,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::id(),
        ]);

        return [
            'data' => $comp,
            'status' => 200,
            'message' => 'Success',
        ];
    }
}
