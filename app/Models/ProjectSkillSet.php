<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSkillSet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'project_id'
    ];
    public function skillsets()
    {
        return $this->belongsTo(OrgProject::class, 'project_id');
    }
}
