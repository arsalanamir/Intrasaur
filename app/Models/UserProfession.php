<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfession extends Model
{
    use HasFactory;
    protected $fillable = [
        'profession_name',
        'user_id'
    ];
    public function userProfessions()
    {
        return $this->belongsTo(User::class);
    }
}
