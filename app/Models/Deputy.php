<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deputy extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experienced()
    {
        return $this->hasMany(SubstituteRequest::class, 'deputy_id', 'user_id')->where('type', 'completed');
    }

    public function findRequest()
    {
        return $this->hasOne(SubstituteRequest::class, 'id', 'substitute_request_id');
    }
}