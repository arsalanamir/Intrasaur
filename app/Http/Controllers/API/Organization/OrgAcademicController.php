<?php

namespace App\Http\Controllers\API\Organization;

use App\Models\User;
use App\Models\OrgAcademic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrgAcademicController extends Controller
{
    public function addOrgAcademic(Request $request)
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
        OrgAcademic::create([
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
    public function deleteOrgAcademic($id)
    {
        OrgAcademic::find($id)->delete();
        $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
