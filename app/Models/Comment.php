<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobOffer;

class Comment extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function JobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
