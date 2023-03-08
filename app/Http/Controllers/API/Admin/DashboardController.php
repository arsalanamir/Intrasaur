<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrgProject;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $allUser = User::where('role', 'user')->count();
        $activeUser = User::where('role', 'user')->where('status', 1)->count();
        $activeOrg = User::where('role', 'org')->count();
        $activeProject = OrgProject::where('status', 1)->count();

        return [
            'allUser' => $allUser,
            'activeUser' => $activeUser,
            'activeOrg' => $activeOrg,
            'activeProject' => $activeProject,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
