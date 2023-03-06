<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgAcademic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id'
    ];
    public function orgAcademic()
    {
        return $this->belongsTo(User::class);
    }
}
