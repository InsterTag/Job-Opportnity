<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
