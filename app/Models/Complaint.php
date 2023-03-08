<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'org_id',
        'issue',
        'description',
        'status',
    ];
    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orgData()
    {
        return $this->belongsTo(User::class, 'org_id');
    }
}
