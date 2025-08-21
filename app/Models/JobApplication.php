<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Unemployed;
use App\Models\JobOffer;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class JobApplication extends Model
{
    use HasFactory;
    public function unemployed()
    {
        return $this->belongsTo(Unemployed::class);
    }

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }

    // Relación con entrevistas
    public function interviews()
    {
        return $this->hasMany(\App\Models\Interview::class);
    }

    // Accessor: URL pública al CV
    public function getCvUrlAttribute()
    {
        return $this->cv_path ? asset('storage/' . $this->cv_path) : null;
    }

    // Accessor: Etiqueta amigable del estado
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pendiente',
            'accepted' => 'Aceptada',
            'rejected' => 'Rechazada',
            'scheduled' => 'Programada',
        ];
        return $labels[$this->status] ?? ucfirst($this->status);
    }

    // Accessor: Clase CSS para badge según estado
    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'pending' => 'badge-warning',
            'accepted' => 'badge-success',
            'rejected' => 'badge-danger',
            'scheduled' => 'badge-info',
        ];
        return $classes[$this->status] ?? 'badge-secondary';
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
















    
    protected $allowIncluded = ['unemployed', 'jobOffer']; 
    protected $allowFilter = ['message', 'unemployed_id', 'job_offer_id'];
    protected $allowSort = ['message', 'unemployed_id', 'job_offer_id'];

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
