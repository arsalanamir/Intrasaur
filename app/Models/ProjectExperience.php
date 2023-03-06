<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'project_id'
    ];
    public function experiance()
    {
        return $this->belongsTo(OrgProject::class, 'project_id');
    }
}
