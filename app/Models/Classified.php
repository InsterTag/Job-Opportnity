<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Unemployed;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
