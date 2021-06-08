<?php

namespace App\Models;

use App\Filters\Id;
use App\Filters\OrderBy;
use App\Filters\PostalCode;
use App\Filters\UserId;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'postal_code',
        'type_accommodation',
        'prospect_type',
        'type_residence',
        'apartment_floor',
        'apartment_surface',
        'room',
        'user_id',
        'contract_id',
        'insured',
        'termination',
        'franchise',
        'furniture_capital',
        'furniture_two_years_old',
        'total_value_furniture_400',
        'total_value_furniture_1800',
        'estimated_coverage',
        'option_glass',
        'option_thief',
        'option_mobile',
        'school_insurance',
        'cost_month',
        'dependencies'
    ];

    const PIPES = [
        Id::class,
        UserId::class,
        PostalCode::class,
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
