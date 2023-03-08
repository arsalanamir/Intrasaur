<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function activeUserData()
    {
        $profile = User::with('profile')->where('role','user')->where('status', 1)->get();
        return [
            'data' => $profile,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function allUserData()
    {
        $profile = User::with('profile')->where('role', 'user')->get();
        return [
            'data' => $profile,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function unActiveUserData()
    {
        $profile = User::with('profile')->where('role', 'user')->where('status', 2)->get();
        return [
            'data' => $profile,
            'status' => 200,
            'message' => 'Success',
        ];
    }

    public function activeOrgData()
    {
        $profile = User::with('orgProfile')->where('role', 'org')->where('status', 1)->get();
        return [
            'data' => $profile,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function allOrgData()
    {
        $profile = User::with('orgProfile')->where('role', 'org')->get();
        return [
            'data' => $profile,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function unActiveOrgData()
    {
        $profile = User::with('orgProfile')->where('role', 'org')->where('status', 2)->get();
        return [
            'data' => $profile,
            'status' => 200,
            'message' => 'Success',
        ];
    }

    public function freezUserData($id)
    {
        $user = User::find($id)->update([
            'status' => 2
        ]);

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }

    public function deleteUserData($id)
    {
        $user = User::find($id)->delete();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function searchUserName(Request $request){

        $searchData = User::with('profile')->where('role', 'user')->where('first_name', 'like', '%' . $request->name . '%')->where('last_name', 'like', '%' . $request->name . '%')->get();
        return [
            'data' => $searchData,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function searchOrgName(Request $request)
    {

        $searchData = User::with('orgProfile')->where('role', 'org')->where('first_name', 'like', '%' . $request->name . '%')->where('last_name', 'like', '%' . $request->name . '%')->get();
        return [
            'data' => $searchData,
            'status' => 200,
            'message' => 'Success',
        ];
    }

}
