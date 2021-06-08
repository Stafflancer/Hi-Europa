<?php

namespace App\Models;

use App\Filters\City;
use App\Filters\Email;
use App\Filters\FirstName;
use App\Filters\Id;
use App\Filters\LastName;
use App\Filters\OrderBy;
use App\Filters\PhoneNumber;
use App\Filters\PostalCode;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        'title',
        'phone_number',
        'landline_phone',
        'email',
        'gender',
        'address',
        'postal_code',
        'opt_in_hieuropa',
        'birthday',
        'residency_type',
        'residence_type',
        'floor',
        'number_rooms',
        'got_insurance',
        'live_there_time',
        'insured_time',
        'is_pb_prime',
        'contract_id',
    ];

    const PIPES = [
        Id::class,
        FirstName::class,
        LastName::class,
        Email::class,
        PhoneNumber::class,
        PostalCode::class,
        City::class,
        OrderBy::class,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new OrderByScope);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotation()
    {
        return $this->hasMany(Quotation::class);
    }
}
