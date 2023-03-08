<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 'user') {
            $user = User::with('profile','professions', 'educations','qualifications','experties','documents')->where( 'id' ,Auth::id())->first();
            }
            if (Auth::user()->role == 'org') {
                $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();
            }
            if (Auth::user()->role == 'admin') {
                $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();
            }
            $success['token'] = $user->createToken('Intrasaur')->plainTextToken;
            return response()->json([
                'data' => $user,
                'success' => $success,
                'token_type' => 'Bearer'
            ], 200);
        } else {
            return response()->json(['error' => 'Invalid Credentails'], 401);
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
