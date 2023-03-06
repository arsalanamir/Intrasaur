<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;
use App\Models\UserExperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserExpertyController extends Controller
{
    public function addUserExperty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'experty' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        UserExperty::create([
            'user_id' => Auth::id(),
            'experty' => $request->experty
        ]);
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function deleteUserExperty($id)
    {
        UserExperty::find($id)->delete();
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
