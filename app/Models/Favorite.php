<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Unemployed;

class Favorite extends Model
{
    protected $fillable = ['unemployed_id', 'favoritable_id', 'favoritable_type'];
    
    public function unemployed()
    {
        return $this->belongsTo(Unemployed::class);
    }

    public function favoritable()
    {
        return $this->morphTo(); // sin cambios aquí
    }
}

