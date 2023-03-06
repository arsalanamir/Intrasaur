<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserEducation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserEducationController extends Controller
{
    public function addUserEducation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institute_name' => 'required',
            'institute_location' => 'required',
            'degree' => 'required',
            'institute_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }

        if ($request->hasFile('institute_image')) {
            $file = $request->file('institute_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('education/', $filename);
        }
        UserEducation::create([
            'institute_image' => $filename ?? null,
            'institute_name' => $request->institute_name,
            'institute_location' => $request->institute_location,
            'degree' => $request->degree,
            'user_id' => Auth::id(),
        ]);
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }

    public function deleteUserEducation($id)
    {
        UserEducation::find($id)->delete();
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
