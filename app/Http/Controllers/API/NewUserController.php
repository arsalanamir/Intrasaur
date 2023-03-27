<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDocument;
use App\Models\UserEducation;
use App\Models\UserExperty;
use App\Models\UserProfession;
use App\Models\UserProfile;
use App\Models\UserQualification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewUserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->institute_name = $request->institute_name;
        $user->country = $request->country;
        $user->website = $request->website;
        $user->role = $request->role;
        $user->email_code = rand(1000, 9999);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $details = [
            'title' => 'Mail from Intrasaur Website',
            'body' => 'Hi, welcome in Intrasaur Website',
            'otp' => $user->email_code,
        ];

        Mail::to($user->email)->send(new \App\Mail\OtpMail($details));
        $success['token'] = $user->createToken('Intrasaur')->plainTextToken;

        UserProfile::create([
            'user_id' => $user->id,
        ]);
        return response()->json([
            'success' => $success,
            'token_type' => 'Bearer'
        ], 201);
    }

    // Verify Email
    public function verifyEmailOtp(Request $req)
    {
        $user = User::find(Auth::id());
        $userOtp = User::where('id', Auth::id())->where('email_code', $req->otp)->first();
        if ($userOtp) {
            $user->update([
                'email_verified_at' => Carbon::now(),
            ]);
            return [
                'status' => 200,
                'message' => 'Email is verified',
            ];
        } else {
            return [
                'status' => 401,
                'message' => 'Please Enter a Valid Otp',
            ];
        }
    }

    // resend email varification code again.
    public function resendEmail()
    {

        $user = User::find(Auth::id());
        $details = [
            'title' => 'Mail from Intrasaur Website',
            'body' => 'Hi, welcome in Intrasaur Website',
            'otp' => $user->email_code,
        ];

        Mail::to(Auth::user()->email)->send(new \App\Mail\OtpMail($details));
        return [
            'status' => 200,
            'message' => 'Otp has been sent ',
        ];
    }
}
