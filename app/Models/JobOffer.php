<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    // Definición de la relación con Company
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
