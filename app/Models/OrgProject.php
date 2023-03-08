<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'overview',
        'app_start_date',
        'app_end_date',
        'project_start_date',
        'Project_end_date',
        'user_id',
        'assignee_id',

    ];
    public function orgProject()
    {
        return $this->belongsTo(User::class);
    }
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
    public function roles()
    {
        return $this->hasMany(ProjectRole::class, 'project_id');
    }
    public function skillsets()
    {
        return $this->hasMany(ProjectSkillSet::class, 'project_id');
    }
    public function hours()
    {
        return $this->hasMany(ProjectHours::class, 'project_id');
    }
    public function checklists()
    {
        return $this->hasMany(ProjectCheckList::class, 'project_id');
    }
    public function experiences()
    {
        return $this->hasMany(ProjectExperience::class, 'project_id');
    }
    public function attachments()
    {
        return $this->hasMany(ProjectAttachments::class, 'project_id');
    }
    public function qualifications()
    {
        return $this->hasMany(ProjectQualification::class, 'project_id');
    }
    public function review()
    {
        return $this->hasMany(Review::class, 'project_id');
    }
}
