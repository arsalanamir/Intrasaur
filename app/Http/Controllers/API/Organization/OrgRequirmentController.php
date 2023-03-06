<?php

namespace App\Http\Controllers\API\Organization;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OrgRequirement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrgRequirmentController extends Controller
{
    public function addOrgRequirment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        OrgRequirement::create([
            'user_id' => Auth::id(),
            'name' => $request->name
        ]);
        $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function deleteOrgRequirment($id)
    {
        OrgRequirement::find($id)->delete();
        $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
