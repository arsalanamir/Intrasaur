<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperty extends Model
{
    protected $fillable = [
        'experty',
        'user_id'
    ];
    public function UserExperties()
    {
        return $this->belongsTo(User::class);
    }
}
