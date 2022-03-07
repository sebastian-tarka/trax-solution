<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['brand', 'model', 'user_id', 'year'];

    /**
     * @return HasMany
     */
    public  function trips():HasMany
    {
        return $this->hasMany(Trip::class);
    }

}
