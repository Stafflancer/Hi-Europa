<?php

namespace App\Models;

use App\Filters\Id;
use App\Filters\OrderBy;
use App\Filters\UserId;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resiliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'moving_out',
        'insurance_company_name',
        'previous_contract',
        'subscription_date',
        'user_id',
        'contract_id',
        'insured_firstname',
        'insured_surname'
    ];

    const  PIPES = [
        Id::class,
        UserId::class,
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
