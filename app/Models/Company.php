<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // Definición de la relación con JobOffer
    public function jobOffer()
    {
        return $this->hasMany('App\Models\JobOffer');
    }
}
