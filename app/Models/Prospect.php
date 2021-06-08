<?php

namespace App\Models;

use App\Filters\ContractId;
use App\Filters\Id;
use App\Filters\OrderBy;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'residency_type',
        'prospect_type',
        'residence_type',
        'floor',
        'surface',
        'number_rooms',
        'got_insurance',
        'live_there_time',
        'insured_time',
        'postal_code',
        'email',
        'opt_in_hieuropa'
    ];

    const PIPES = [
        Id::class,
        ContractId::class,
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
}
