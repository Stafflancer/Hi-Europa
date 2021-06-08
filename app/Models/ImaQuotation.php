<?php

namespace App\Models;

use App\Filters\Id;
use App\Filters\OrderBy;
use App\Filters\ImaUserId;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImaQuotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'problem_type',
        'precision_one',
        'precision_two',
        'precision_tree',
        'intervention_date',
        'start_time',
        'cost',
        'ima_user_id',
    ];

    const PIPES = [
        Id::class,
        ImaUserId::class,
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
        return $this->belongsTo(ImaUser::class, 'ima_user_id');
    }
}
