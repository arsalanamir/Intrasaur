<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'biography',
        'location',
        'user_id'
    ];
    public function orgProfile()
    {
        return $this->belongsTo(User::class);
    }
}
