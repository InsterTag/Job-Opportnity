<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = ['job_application_id', 'scheduled_at', 'duration_minutes', 'mode', 'location', 'notes', 'status'];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }

    // Accessor: Etiqueta amigable del estado (español)
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pendiente',
            'accepted' => 'Aceptada',
            'rejected' => 'Rechazada',
            'scheduled' => 'Programada',
            'cancelled' => 'Cancelada',
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
            'cancelled' => 'badge-secondary',
        ];
        return $classes[$this->status] ?? 'badge-secondary';
    }
}
