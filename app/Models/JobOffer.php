<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    protected $table = 'job_offers';

    // Relación con Company (muchos a uno)
    public function company()
    {
        return $this->belongsTo(Company::class, 'id');
    }

    // Relación con Unemployed (muchos a muchos)
    public function unemployed()
    {
        return $this->belongsToMany(Unemployed::class, 'job_offers_unemployed', 'job_offers_id', 'unemploy_id');
    }

    // Relación con Classified (uno a muchos)
    public function classifieds()
    {
        return $this->hasMany(Classified::class, 'id');
    }
}
