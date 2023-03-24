<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrgProject;
use App\Models\Review;
use App\Models\UserDocument;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $allUser = User::where('role', 'user')->count();
        $activeUser = User::where('role', 'user')->where('status', 1)->count();
        $activeOrg = User::where('role', 'org')->count();
        $activeProject = OrgProject::where('status', 1)->count();
        $awaitingCertificateForUser = UserDocument::where('is_verified', 0)->count();
        $rejectedCertificateForUser = UserDocument::where('is_verified', 2)->count();
        $awaitingReviewForUser = Review::where('status', 0)->count();
        $rejectedReviewForUser = Review::where('status', 2)->count();


        return [
            'newUser' => $allUser,
            'activeUser' => $activeUser,
            'newOrg' => $activeOrg,
            'activeProject' => $activeProject,
            'awaitingAprovalCertificateForUser' => $awaitingCertificateForUser,
            'rejectedCertificateForUser' => $rejectedCertificateForUser,
            'awaitingReviewForUser' => $awaitingReviewForUser,
            'rejectedReviewForUser' => $rejectedReviewForUser,
            'status' => 200,
            'message' => 'success',
        ];
    }

    public function AlluserDataWithCount()
    {
        $allUser = User::with('profile')->where('role', 'user')->with('countDocuments', 'countUserReview')->get();
        return [
            'alluser' => $allUser,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
