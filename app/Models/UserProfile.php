<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_image',
        'biography',
        'user_id'
    ];
    public function userProfile()
    {
        return $this->belongsTo(User::class);
    }
}
