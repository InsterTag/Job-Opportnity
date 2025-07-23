<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Unemployed;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Classified extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'description',
    'location',
    'geolocation',
    'salary',
    'company_id',
    'unemployed_id',
    ];


    protected $casts = [
        'date' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function unemployed()
    {
        return $this->belongsTo(Unemployed::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function favoritedBy()
    {
        return $this->morphToMany(Unemployed::class, 'favoritable', 'favorites');
    }

    // Accesor opcional para obtener el creador
    public function getCreatorAttribute()
    {
        return $this->company ?? $this->unemployed;
    }















    
    protected $allowIncluded = ['company', 'unemoployed']; 
    protected $allowFilter = ['title','description','location','geolocation','salary','company_id','unemployed_id',];
    protected $allowSort = ['title','description','location', 'geolocation','salary','company_id','unemployed_id',];

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
