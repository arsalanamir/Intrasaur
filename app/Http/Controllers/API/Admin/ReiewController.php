<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReiewController extends Controller
{
    public function userReview(){
      $review = Review::with('reviewSander', 'project', 'reviewReceiver')->whereHas('reviewSander', function ($query) {
            $query->where('role', 'user');
        })->get();
        return [
            'data' => $review,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function orgReview()
    {
        $review = Review::with('reviewSander', 'project', 'reviewReceiver')->whereHas('reviewSander', function ($query) {
            $query->where('role', 'org');
        })->get();
        return [
            'data' => $review,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function approvedReview($id)
    {
        $review = Review::find($id)->update([
            'status' => 1,
        ]);
        return [
            'data' => $review,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function rejectReview($id)
    {
        $review = Review::find($id)->update([
            'status' => 2,
        ]);
        return [
            'data' => $review,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function rejectReviewWithReason(Request $request)
    {
        $review = Review::find($request->id)->update([
            'status' => 2,
            'reject_reason' => $request->reason,
        ]);
        return [
            'data' => $review,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function addReview(Request $request){
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'receiver_id' => 'required',
            'rating' => 'required',
            'heading' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $review = Review::create([
            'project_id' => $request->project_id,
            'receiver_id' => $request->receiver_id,
            'rating' => $request->rating,
            'heading' => $request->heading,
            'description' => $request->description,
            'sender_id'=>Auth::id(),
        ]);

        return [
            'data' => $review,
            'status' => 200,
            'message' => 'Success',
        ];
    }
}
