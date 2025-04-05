<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    // Relación con JobOffer (uno a muchos)
    public function jobOffers()
    {
        return $this->belongsTo(JobOffer::class, 'id');
    }

    // Relación con User (opcional, si una compañía pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
