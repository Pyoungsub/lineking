<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubstituteRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deputy()
    {
        return $this->hasOne(Deputy::class)->ofMany('amount','min');
    }

    public function applicants()
    {
        return $this->hasMany(Deputy::class);
    }

    public function selectedApplicant()
    {
        return $this->hasOne(Deputy::class, 'user_id', 'deputy_id');
    }

    public function chatHistory()
    {
        return $this->hasMany(Conversation::class);
    }
}