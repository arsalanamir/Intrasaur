<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_name',
        'detail',
        'document_image',
        'is_verfied',
        'user_id'
    ];
    public function orgDocuments()
    {
        return $this->belongsTo(User::class);
    }
}
