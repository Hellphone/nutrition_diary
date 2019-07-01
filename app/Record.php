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

    private $basicWeight = 100;

    private $proteinKcal = 4;
    private $fatKcal = 9;
    private $carbKcal = 4;

    public function calculateKcal()
    {
        $relation = $this->basicWeight / $this->weight;
        $Kcal = ($this->product->proteins * $this->proteinKcal
            + $this->product->fats * $this->fatKcal
            + $this->product->carbs * $this->carbKcal) / $relation;

        return $Kcal;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
