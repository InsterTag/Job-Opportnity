<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Unemployed;
use App\Models\Notification;
use App\Models\Message;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    public function Company()
    {
        return $this->hasOne(Company::class);
    }

    public function Unemployed()
    {
        return $this->hasOne(Unemployed::class);
    }

    public function Notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function SentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function ReceivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function isCompany(): bool
    {
        return $this->type === 'company';
    }

    public function isUnemployed(): bool
    {
        return $this->type === 'unemployed';
    }













    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
