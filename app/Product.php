<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'proteins',
        'fats',
        'carbs'
    ];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
