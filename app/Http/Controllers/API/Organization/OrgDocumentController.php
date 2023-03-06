<?php

namespace App\Http\Controllers\API\Organization;

use App\Models\User;
use App\Models\OrgDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrgDocumentController extends Controller
{
    public function addOrgDocument(Request $request)
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
        OrgDocument::create([
            'document_name' => $request->document_name,
            'detail' => $request->detail,
            'document_image' => $filename ?? null,
            'is_verfied' => false,
            'user_id' => Auth::id(),
        ]);
        $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }

    public function deleteOrgDocument($id)
    {
        OrgDocument::find($id)->delete();
        $user = User::with('orgProfile', 'orgAcademic', 'orgDocument', 'orgRequirement', 'orgSpecialisation')->where('id', Auth::id())->first();

        return [
            'data' => $user,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
