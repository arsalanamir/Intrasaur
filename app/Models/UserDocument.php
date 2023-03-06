<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_name',
        'detail',
        'document_image',
        'is_verfied',
        'user_id'
    ];
    public function userDocuments()
    {
        return $this->belongsTo(User::class);
    }
}
