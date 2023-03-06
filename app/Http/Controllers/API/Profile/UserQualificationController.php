<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserQualification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserQualificationController extends Controller
{
    public function addUserQualification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qualification' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }

        $userQualification = UserQualification::create([
            'user_id' => Auth::id(),
            'qualification' => $request->qualification
        ]);
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function deleteUserQualification($id)
    {
        UserQualification::find($id)->delete();
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
