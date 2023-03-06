<?php

namespace App\Http\Controllers\API\Organization;

use App\Models\OrgProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectAttachments;
use App\Models\ProjectCheckList;
use App\Models\ProjectExperience;
use App\Models\ProjectHours;
use App\Models\ProjectQualification;
use App\Models\ProjectRole;
use App\Models\ProjectSkillSet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrgProjectController extends Controller
{
    public function store(Request $request)
    {

        // dd($request->images[0]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'overview' => 'required',
            'app_start_date' => 'required',
            'app_end_date' => 'required',
            'project_start_date' => 'required',
            'Project_end_date' => 'required',
            'role' => 'required',
            'skillset' => 'required',
            'qualification' => 'required',
            'hours' => 'required',
            'experiance' => 'required',
            'checklist' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }

        $project = OrgProject::create([
            'name' => $request->name,
            'description' => $request->description,
            'overview' => $request->overview,
            'app_start_date' => $request->app_start_date,
            'app_end_date' => $request->app_end_date,
            'project_start_date' => $request->project_start_date,
            'Project_end_date' => $request->Project_end_date,
            'user_id' => Auth::id(),
        ]);
        foreach (json_decode($request->role) as $key => $value) {
            ProjectRole::create([
                'project_id' => $project->id,
                'name' => $value->name
            ]);
        }
        foreach (json_decode($request->skillset) as $key => $value) {
            ProjectSkillSet::create([
                'project_id' => $project->id,
                'name' => $value->name
            ]);
        }
        foreach (json_decode($request->qualification) as $key => $value) {
            ProjectQualification::create([
                'project_id' => $project->id,
                'name' => $value->name
            ]);
        }
        foreach (json_decode($request->hours) as $key => $value) {
            ProjectHours::create([
                'project_id' => $project->id,
                'name' => $value->name
            ]);
        }
        foreach (json_decode($request->experiance) as $key => $value) {
            ProjectExperience::create([
                'project_id' => $project->id,
                'name' => $value->name
            ]);
        }
        foreach (json_decode($request->checklist) as $key => $value) {
            ProjectCheckList::create([
                'project_id' => $project->id,
                'name' => $value->name
            ]);
        }
        foreach ($request->images as $value) {
            $file = $value;
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('education/', $filename);
            ProjectAttachments::create([
                'attachment' => $filename,
                'project_id' => $project->id,

            ]);
        }
        $projectDetails = OrgProject::with('roles', 'skillsets', 'hours', 'checklists', 'experiences', 'qualifications', 'attachments')->find($project->id);
        return [
            'data' => $projectDetails,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function editProject($id)
    {
        $projectDetails = OrgProject::with('roles', 'skillsets', 'hours', 'checklists', 'experiences', 'qualifications', 'attachments')->find($id);
        return [
            'data' => $projectDetails,
            'status' => 200,
            'message' => 'success',
        ];
    }


    public function update(Request $request)
    {

        // dd($request->images[0]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'overview' => 'required',
            'app_start_date' => 'required',
            'app_end_date' => 'required',
            'project_start_date' => 'required',
            'Project_end_date' => 'required',
            'role' => 'required',
            'skillset' => 'required',
            'qualification' => 'required',
            'hours' => 'required',
            'experiance' => 'required',
            'checklist' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }

        OrgProject::find($request->project_id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'overview' => $request->overview,
            'app_start_date' => $request->app_start_date,
            'app_end_date' => $request->app_end_date,
            'project_start_date' => $request->project_start_date,
            'Project_end_date' => $request->Project_end_date,
            'user_id' => Auth::id(),
        ]);
        ProjectRole::where('project_id', $request->project_id)->delete();
        foreach (json_decode($request->role) as $key => $value) {
            ProjectRole::create([
                'project_id' => $request->project_id,
                'name' => $value->name
            ]);
        }
        ProjectSkillSet::where('project_id', $request->project_id)->delete();
        foreach (json_decode($request->skillset) as $key => $value) {
            ProjectSkillSet::create([
                'project_id' => $request->project_id,
                'name' => $value->name
            ]);
        }
        ProjectQualification::where('project_id', $request->project_id)->delete();
        foreach (json_decode($request->qualification) as $key => $value) {
            ProjectQualification::create([
                'project_id' => $request->project_id,
                'name' => $value->name
            ]);
        }
        ProjectHours::where('project_id', $request->project_id)->delete();
        foreach (json_decode($request->hours) as $key => $value) {
            ProjectHours::create([
                'project_id' => $request->project_id,
                'name' => $value->name
            ]);
        }
        ProjectExperience::where('project_id', $request->project_id)->delete();
        foreach (json_decode($request->experiance) as $key => $value) {
            ProjectExperience::create([
                'project_id' => $request->project_id,
                'name' => $value->name
            ]);
        }
        ProjectCheckList::where('project_id', $request->project_id)->delete();
        foreach (json_decode($request->checklist) as $key => $value) {
            ProjectCheckList::create([
                'project_id' => $request->project_id,
                'name' => $value->name
            ]);
        }
        ProjectAttachments::where('project_id', $request->project_id)->delete();
        foreach ($request->images as $value) {
            $file = $value;
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('education/', $filename);
            ProjectAttachments::create([
                'attachment' => $filename,
                'project_id' => $request->project_id,

            ]);
        }
        $projectDetails = OrgProject::with('roles', 'skillsets', 'hours', 'checklists', 'experiences', 'qualifications', 'attachments')->find($request->project_id);
        return [
            'data' => $projectDetails,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function deleteProject($id)
    {
        ProjectHours::where('project_id', $id)->delete();
        ProjectQualification::where('project_id', $id)->delete();
        ProjectSkillSet::where('project_id', $id)->delete();
        ProjectRole::where('project_id', $id)->delete();
        ProjectCheckList::where('project_id', $id)->delete();
        ProjectExperience::where('project_id', $id)->delete();
        ProjectAttachments::where('project_id', $id)->delete();

        OrgProject::find($id)->delete();
        return [
            'status' => 200,
            'message' => 'success',
        ];
    }

    public function assignee(Request $request) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'assignee_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 401,
            ]);
        }
        $project = OrgProject::find($request->project_id);
        $project->update([
            'assignee_id'=>$request->assignee_id
        ]);
        $projectDetails = OrgProject::with('roles', 'skillsets', 'hours', 'checklists', 'experiences', 'qualifications', 'attachments', 'assignee')->where('status', 1)->find($project->id);
        return [
            'data' => $projectDetails,
            'status' => 200,
            'message' => 'success',
        ];

    }
        public function allProjects()
    {
        $projectDetails = OrgProject::with('roles', 'skillsets', 'hours', 'checklists', 'experiences', 'qualifications', 'attachments', 'assignee')->where('status',1)->where('user_id', Auth::id())->get()->groupBy('assignee_id');
        return [
            'data' => $projectDetails,
            'status' => 200,
            'message' => 'success',
        ];
    }
    public function allCloseProjects()
    {
        $projectDetails = OrgProject::with('roles', 'skillsets', 'hours', 'checklists', 'experiences', 'qualifications', 'attachments', 'assignee')->where('status', 2)->where('user_id', Auth::id())->get()->groupBy('assignee_id');
        return [
            'data' => $projectDetails,
            'status' => 200,
            'message' => 'success',
        ];
    }
}
