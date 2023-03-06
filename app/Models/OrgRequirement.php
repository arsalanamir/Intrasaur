<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgRequirement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id'
    ];
    public function orgRequirment()
    {
        return $this->belongsTo(User::class);
    }
}
