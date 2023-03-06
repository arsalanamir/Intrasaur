<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserDocumentController extends Controller
{
    public function addUserDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_name' => 'required',
            'detail' => 'required',
            'document_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        if ($request->hasFile('document_image')) {
            $file = $request->file('document_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('education/', $filename);
        }
        UserDocument::create([
            'document_name' => $request->document_name,
            'detail' => $request->detail,
            'document_image' => $filename ?? null,
            'is_verfied' => false,
            'user_id' => Auth::id(),
        ]);
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }

    public function deleteUserDocument($id)
    {
        UserDocument::find($id)->delete();
        $user = User::with('profile', 'professions', 'educations', 'qualifications', 'experties', 'documents')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
