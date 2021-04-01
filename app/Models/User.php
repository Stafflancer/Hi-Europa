<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
    ];

    protected $appends = ['service_name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wakam_service()
    {
        return $this->hasOne(WakamService::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ima_service()
    {
        return $this->hasOne(ImaService::class);
    }

    /**
     * @return string
     */
    public function getServiceNameAttribute()
    {
        return $this->wakam_service()->first() ? 'Wakam' : 'Ima';
    }
}
