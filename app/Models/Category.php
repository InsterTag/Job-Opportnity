<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JobOffer;
use App\Models\Classified;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function jobOffers()
    {
        return $this->morphedByMany(JobOffer::class, 'categorizable');
    }
    
    public function classifieds()
    {
        return $this->morphedByMany(Classified::class, 'categorizable');
    }
}
