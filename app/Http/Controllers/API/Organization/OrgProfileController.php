<?php

namespace App\Http\Controllers\API\Organization;

use App\Models\User;
use App\Models\OrgProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrgProfileController extends Controller
{
    public function updateOrgProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required_without:biography',
            'biography' => 'required_without:image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('profile/', $filename);
        }
        $userProfile = OrgProfile::where('user_id', Auth::id())->first();
        $userProfile->update([
            'image' => $filename ?? $userProfile->image ?? null,
            'biography' => $request->biography ?? $userProfile->biography,
            'location' => $request->location ?? $userProfile->location,
            'user_id' => Auth::id(),

        ]);
        $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
