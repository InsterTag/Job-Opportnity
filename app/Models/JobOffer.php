<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\Comment;
use App\Models\FavoriteOffer;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JobOfferCategory;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'salary',
        'location',
        'geolocation',
        'offer_type'
    ];

    protected $casts = [
        'salary' => 'decimal:2'
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    public function JobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function FavoriteOffers()
    {
        return $this->hasMany(FavoriteOffer::class);
    }

    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'job_offer_category');
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
}
