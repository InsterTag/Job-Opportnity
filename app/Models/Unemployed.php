<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\Portfolio;
use App\Models\Favorite;
use App\Models\TrainingUser;
use Illuminate\Database\Eloquent\Builder;

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


















    
    protected $allowIncluded = ['user']; 
    protected $allowFilter = ['user_id', 'profession', 'experience', 'location'];
    protected $allowSort = ['user_id', 'profession', 'experience', 'location'];

    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) { 
            return;
        }
        $relations  = explode(',', request('included')); 
        $allowIncluded = collect($this->allowIncluded); 
        foreach ($relations as $key => $relationship) { 
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }
        $query->with($relations); 
    }

    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }
        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);
        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }


        public function scopeSort(Builder $query)
    {
    if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }
        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);
        foreach ($sortFields as $sortField) {
            $direction = 'asc';
            if(substr($sortField, 0,1)=='-'){ 
                $direction = 'desc';
                $sortField = substr($sortField,1);
            }
            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }


    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage'));
            if($perPage){
                return $query->paginate($perPage);
            }
            }
            return $query->get();
    }
}
