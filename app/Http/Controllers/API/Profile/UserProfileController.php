<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required_without:biography',
            'biography' => 'required_without:profile_image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('profile/', $filename);
        }
        $userProfile = UserProfile::where('user_id',Auth::id())->first();
        $userProfile->update([
            'profile_image' => $filename ?? null,
            'biography' => $request->biography,
            'user_id' => Auth::id(),

        ]);
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
