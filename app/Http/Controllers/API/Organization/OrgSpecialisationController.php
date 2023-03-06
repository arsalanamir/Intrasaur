<?php

namespace App\Http\Controllers\API\Organization;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OrgSpecialisation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrgSpecialisationController extends Controller
{
    public function addOrgSpecialisation(Request $request)
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
        OrgSpecialisation::create([
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
    public function deleteOrgSpecialisation($id)
    {
        OrgSpecialisation::find($id)->delete();
        $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
