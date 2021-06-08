<?php

namespace App\Models;

use App\Filters\Id;
use App\Filters\ImaUserId;
use App\Filters\OrderBy;
use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'address',
        'comp_address',
        'city',
        'attendance_person',
        'other_person_first_name',
        'other_person_last_name',
        'other_person_phone',
        'ima_user_id'
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
