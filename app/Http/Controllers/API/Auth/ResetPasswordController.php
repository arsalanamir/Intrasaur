<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function setPassword(Request $request)
    { {
            $request->validate([
                'code' => 'required|string|exists:reset_code_passwords',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            // find the code
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

            // check if it does not expired: the time is one hour
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();
                return response(['message' => trans('passwords.code_is_expire')], 422);
            }

            // find user's email
            $user = User::firstWhere('email', $passwordReset->email);

            // update user password

            $user->update([
               'password' => bcrypt($request->password),
            ]);

            // delete current code
            $passwordReset->delete();

            return response(['message' => 'password has been successfully reset'], 200);
        }
    }
}
