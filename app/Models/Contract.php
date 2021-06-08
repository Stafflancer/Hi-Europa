<?php

namespace App\Models;

use App\Filters\City;
use App\Filters\Id;
use App\Filters\OrderBy;
use App\Filters\PostalCode;
use App\Filters\PostCode;
use App\Filters\UserId;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $appends = [
        'pdf_link'
    ];

    protected $fillable = [
        'exact_address',
        'additional_address',
        'city',
        'postal_code',
        'contract_start_date',
        'contract_expiration_date',
        'dependance_postal_code',
        'dependance_adresse',
        'dependance_comp_adresse',
        'dependance_city',
        'user_id',
        'quotation_id',
        'price_per_month',
        'resiliation_id',
        'transfer_date'
    ];

    const PIPES = [
        Id::class,
        UserId::class,
        PostalCode::class,
        PostCode::class,
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
     * @return string
     */
    public function getPdfLinkAttribute()
    {
        if ($this->pdf) {
            return asset('storage/contract-pdfs/' . $this->pdf);
        }
        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function quotation()
    {
        return $this->hasOne(Quotation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function resiliation()
    {
        return $this->hasOne(Resiliation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
