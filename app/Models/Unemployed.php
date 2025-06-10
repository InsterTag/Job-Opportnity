<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\Portfolio;
use App\Models\FavoriteOffer;
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

    public function favoriteOffers()
    {
        return $this->belongsToMany(JobOffer::class, 'favorite_offers', 'unemployed_id', 'job_offer_id')
                    ->withTimestamps();
    }

    public function TrainingUsers()
    {
        return $this->hasMany(TrainingUser::class);
    }
}
