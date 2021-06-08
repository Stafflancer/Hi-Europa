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

class ImaUser extends Model
{
    use HasFactory;

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
        'title',
        'postal_code',
        'prospect_type',
        'account_id',
    ];

    // pipes
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
    public function quotation()
    {
        return $this->hasOne(ImaQuotation::class, 'ima_user_id');
    }
}
