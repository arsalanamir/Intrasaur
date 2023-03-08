<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrgDocument;
use App\Models\UserDocument;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function allUserDocuments(){
        $allDocuments = UserDocument::with('userDocuments')->get();
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function approvedUserDocuments($id)
    {
        $allDocuments = UserDocument::find($id)->update([
            'is_verfied' => 1,
        ]);
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function rejectUserDocuments($id)
    {
        $allDocuments = UserDocument::find($id)->update([
            'is_verfied' => 2,
        ]);
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function rejectUserDocumentsWithReason(Request $request)
    {
        $allDocuments = UserDocument::find($request->id)->update([
            'is_verfied' => 2,
            'reject_reason'=>$request->reason,
        ]);
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function searchUserDocumentName(Request $request)
    {

        $searchData = UserDocument::with('userDocuments')->where('document_name', 'like', '%' . $request->name . '%')->get();
        return [
            'data' => $searchData,
            'status' => 200,
            'message' => 'Success',
        ];
    }
    public function allOrgDocuments()
    {
        $allDocuments = OrgDocument::with('OrgDocuments')->get();
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function approvedOrgDocuments($id)
    {
        $allDocuments = OrgDocument::find($id)->update([
            'is_verfied' => 1,
        ]);
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function rejectOrgDocuments($id)
    {
        $allDocuments = OrgDocument::find($id)->update([
            'is_verfied' => 2,
        ]);
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function rejectOrgDocumentsWithReason(Request $request)
    {
        $allDocuments = OrgDocument::find($request->id)->update([
            'is_verfied' => 2,
            'reject_reason' => $request->reason,
        ]);
        return [
            'data' => $allDocuments,
            'status' => 200,
            'message' => 'Status Updated',
        ];
    }
    public function searchOrgDocumentName(Request $request)
    {

        $searchData = OrgDocument::with('OrgDocuments')->where('document_name', 'like', '%' . $request->name . '%')->get();
        return [
            'data' => $searchData,
            'status' => 200,
            'message' => 'Success',
        ];
    }
}
