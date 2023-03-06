<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAttachments extends Model
{
    use HasFactory;
    protected $fillable = [
        'attachment',
        'project_id'
    ];
    public function attachments()
    {
        return $this->belongsTo(OrgProject::class, 'project_id');
    }
}
