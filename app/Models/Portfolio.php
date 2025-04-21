<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Unemployed;

class Portfolio extends Model
{

    // Agregar 'unemployed_id' al array $fillable
    protected $fillable = ['unemployed_id', 'title', 'description', 'url'];
    
    public function Unemployed()
    {
        return $this->belongsTo(Unemployed::class);
    }
}