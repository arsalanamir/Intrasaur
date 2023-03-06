<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function getAllusers(){
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents', 'assignedProject')->where('role', 'user')->get();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];

    }

    public function userProfile($id)
    {
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents', 'assignedProject')->find($id);

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
