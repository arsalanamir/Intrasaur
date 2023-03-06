<?php

use App\Http\Controllers\API\Auth\CodeCheckController;
use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Organization\OrgAcademicController;
use App\Http\Controllers\API\Organization\OrgDocumentController;
use App\Http\Controllers\API\Organization\OrgProfileController;
use App\Http\Controllers\API\Organization\OrgProjectController;
use App\Http\Controllers\API\Organization\OrgRequirmentController;
use App\Http\Controllers\API\Organization\OrgSpecialisationController;
use App\Http\Controllers\API\Profile\UserController;
use App\Http\Controllers\API\Profile\UserDocumentController;
use App\Http\Controllers\API\Profile\UserEducationController;
use App\Http\Controllers\API\Profile\UserExpertyController;
use App\Http\Controllers\API\Profile\UserProfessionController;
use App\Http\Controllers\API\Profile\UserProfileController;
use App\Http\Controllers\API\Profile\UserQualificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::post('password/email',  [ForgotPasswordController::class, 'sendEmail']);
Route::post('password/code/check', [CodeCheckController::class, 'checkCode']);
Route::post('password/reset', [ResetPasswordController::class, 'setPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/verify/otp', [RegisterController::class, 'verifyEmailOtp']);
    Route::post('/resend/email', [RegisterController::class, 'resendEmail']);
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::post('/updateProfile', [UserProfileController::class, 'updateProfile']);

    Route::post('/addUserEducation', [UserEducationController::class, 'addUserEducation']);
    Route::get('/deleteUserEducation/{id}', [UserEducationController::class, 'deleteUserEducation']);

    Route::post('/addUserDocument', [UserDocumentController::class, 'addUserDocument']);
    Route::get('/deleteUserDocument/{id}', [UserDocumentController::class, 'deleteUserDocument']);

    Route::post('/addUserExperty', [UserExpertyController::class, 'addUserExperty']);
    Route::get('/deleteUserExperty/{id}', [UserExpertyController::class, 'deleteUserExperty']);

    Route::post('/addUserProfession', [UserProfessionController::class, 'addUserProfession']);
    Route::get('/deleteUserProfession/{id}', [UserProfessionController::class, 'deleteUserProfession']);

    Route::post('/addUserQualification', [UserQualificationController::class, 'addUserQualification']);
    Route::get('/deleteUserQualification/{id}', [UserQualificationController::class, 'deleteUserQualification']);


    Route::post('/updateOrgProfile', [OrgProfileController::class, 'updateOrgProfile']);

    Route::post('/addOrgAcademic', [OrgAcademicController::class, 'addOrgAcademic']);
    Route::get('/deleteOrgAcademic/{id}', [OrgAcademicController::class, 'deleteOrgAcademic']);

    Route::post('/addOrgDocument', [OrgDocumentController::class, 'addOrgDocument']);
    Route::get('/deleteOrgDocument/{id}', [OrgDocumentController::class, 'deleteOrgDocument']);

    Route::post('/addOrgRequirment', [OrgRequirmentController::class, 'addOrgRequirment']);
    Route::get('/deleteOrgRequirment/{id}', [OrgRequirmentController::class, 'deleteOrgRequirment']);

    Route::post('/addOrgSpecialisation', [OrgSpecialisationController::class, 'addOrgSpecialisation']);
    Route::get('/deleteOrgSpecialisation/{id}', [OrgSpecialisationController::class, 'deleteOrgSpecialisation']);

    Route::post('/store', [OrgProjectController::class, 'store']);
    Route::post('/update', [OrgProjectController::class, 'update']);
    Route::get('/editProject/{id}', [OrgProjectController::class, 'editProject']);
    Route::get('/allProjects', [OrgProjectController::class, 'allProjects']);
    Route::get('/deleteProject/{id}', [OrgProjectController::class, 'deleteProject']);
    Route::post('/assignee', [OrgProjectController::class, 'assignee']);
    Route::get('/allCloseProjects', [OrgProjectController::class, 'allCloseProjects']);

    Route::get('/allUsers', [UserController::class, 'getAllusers']);
    Route::get('/userProfile/{id}', [UserController::class, 'userProfile']);



});

Route::middleware('auth:verified')->group(function () {
});
