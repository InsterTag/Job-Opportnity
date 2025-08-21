<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\Comment;
use App\Models\Favorites;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JobOfferCategory;
use Illuminate\Database\Eloquent\Builder;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'salary', 'location', 'geolocation', 'company_id'];

    protected $casts = [
        'salary' => 'decimal:2'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function JobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // Alias en minúsculas para compatibilidad con vistas y convenciones
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    
    public function favoritedBy()
    {
        return $this->morphToMany(Unemployed::class, 'favoritable', 'favorites');
    }

    public function Categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function Notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function getContractTypeAttribute($value)
    {
        $types = [
            'tiempo_completo' => 'Tiempo Completo',
            'medio_tiempo' => 'Medio Tiempo',
            'proyecto' => 'Proyecto',
            'practicas' => 'Prácticas'
        ];
        return $types[$value] ?? ucfirst($value);
    }

    public function getExperienceLevelAttribute($value)
    {
        $levels = [
            'junior' => 'Junior',
            'medio' => 'Medio',
            'senior' => 'Senior',
            'lead' => 'Lead'
        ];
        return $levels[$value] ?? ucfirst($value);
    }

    public function getSalaryFormattedAttribute()
    {
        return $this->salary ? '$ ' . number_format($this->salary, 2) : 'No especificado';
    }

    public function favoriteUnemployed()
    {
        return $this->belongsToMany(Unemployed::class, 'favorite_offers', 'job_offer_id', 'unemployed_id');
    }














    
    protected $allowIncluded = ['company']; 
    protected $allowFilter = ['title', 'description', 'salary', 'location', 'geolocation', 'company_id'];
    protected $allowSort = ['title', 'description', 'salary', 'location', 'geolocation', 'company_id'];

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
