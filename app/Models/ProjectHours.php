<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHours extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'project_id'
    ];
    public function hours()
    {
        return $this->belongsTo(OrgProject::class, 'project_id');
    }
}
