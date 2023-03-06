<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserProfession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfessionController extends Controller
{
    public function addUserProfession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profession_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }

         UserProfession::create([
            'user_id' => Auth::id(),
            'profession_name' => $request->profession_name
        ]);
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function deleteUserProfession($id)
    {
        UserProfession::find($id)->delete();
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
