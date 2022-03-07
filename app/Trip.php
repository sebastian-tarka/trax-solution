<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Trip extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['date', 'car_id', 'user_id', 'distance'];

    public function car():BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * @param $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromTimeString($value)->toDateString();
    }
}
