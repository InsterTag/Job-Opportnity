<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\Portfolio;
use App\Models\Favorite;
use App\Models\TrainingUser;

class Unemployed extends Model
{

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function JobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function Portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function favorites()
    {
    return $this->hasMany(Favorite::class);
    }

    public function favoriteJobOffers()
    {
    return $this->morphedByMany(JobOffer::class, 'favoritable', 'favorites');
    }

    public function favoriteClassifieds()
    {
    return $this->morphedByMany(Classified::class, 'favoritable', 'favorites');
    }
        

    public function TrainingUsers()
    {
        return $this->hasMany(TrainingUser::class);
    }
}
