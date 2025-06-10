<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Unemployed;
use App\Models\JobOffer;

class FavoriteOffer extends Model
{
    protected $fillable = ['unemployed_id', 'job_offer_id'];
    
    public function unemployed()
    {
        return $this->belongsTo(Unemployed::class);
    }

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
