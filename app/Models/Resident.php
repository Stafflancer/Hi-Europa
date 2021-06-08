<?php

namespace App\Models;

use App\Filters\ContractId;
use App\Filters\FirstName;
use App\Filters\Id;
use App\Filters\LastName;
use App\Filters\OrderBy;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'birthday',
        'status',
        'contract_id'
    ];

    const PIPES = [
        Id::class,
        FirstName::class,
        LastName::class,
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
