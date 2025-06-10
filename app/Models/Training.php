<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainingUser;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'provider',
        'start_date',
        'end_date',
    ];
}
