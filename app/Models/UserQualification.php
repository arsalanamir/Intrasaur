<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    use HasFactory;
    protected $fillable = [
        'qualification',
        'user_id'
    ];
    public function UserQualifications()
    {
        return $this->belongsTo(User::class);
    }
}
