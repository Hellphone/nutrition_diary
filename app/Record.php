<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'product_id',
        'weight',
        'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
