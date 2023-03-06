<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'project_id'
    ];
    public function role()
    {
        return $this->belongsTo(OrgProject::class, 'project_id');
    }
}
