<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_name',
        'institute_image',
        'institute_location',
        'degree',
        'user_id'
    ];
    public function userEducations()
    {
        return $this->belongsTo(User::class);
    }
}
