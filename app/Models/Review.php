<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'sender_id',
        'receiver_id',
        'rating',
        'heading',
        'description',
        'reject_reason',
        'status',
    ];
    public function project()
    {
        return $this->belongsTo(OrgProject::class, 'project_id');
    }
    public function reviewSander()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function reviewReceiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
