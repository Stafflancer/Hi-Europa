<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $appends = ['service_name', 'service'];

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
    /**
     * @return string
     */
    public function getServiceAttribute()
    {
        return $this->wakam_service()->first() ? $this->wakam_service()->first() : $this->ima_service()->first();
    }
}
