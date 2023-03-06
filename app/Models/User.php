<?php

namespace App\Models;

use App\Models\OrgSpecialisation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'institute_name',
        'country',
        'website',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function documents()
    {
        return $this->hasMany(UserDocument::class);
    }

    public function educations()
    {
        return $this->hasMany(UserEducation::class);
    }

    public function experties()
    {
        return $this->hasMany(UserExperty::class);
    }

    public function professions()
    {
        return $this->hasMany(UserProfession::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function qualifications()
    {
        return $this->hasMany(UserQualification::class);
    }

    public function orgProfile()
    {
        return $this->hasOne(OrgProfile::class);
    }

    public function orgAcademic()
    {
        return $this->hasMany(OrgAcademic::class);
    }

    public function orgDocument()
    {
        return $this->hasMany(OrgDocument::class);
    }

    public function orgRequirement()
    {
        return $this->hasMany(OrgRequirement::class);
    }

    public function orgSpecialisation()
    {
        return $this->hasMany(OrgSpecialisation::class);
    }
    public function assignedProject()
    {
        return $this->hasMany(OrgProject::class, 'assignee_id');
    }

}
