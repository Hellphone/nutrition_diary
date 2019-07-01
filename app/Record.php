<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'weight',
        'date',
    ];

    const BASIC_WEIGHT = 100;

    const PROTEIN_KCAL = 4;
    const FAT_KCAL = 9;
    const CARB_KCAL = 4;

    /**
     * @return int
     */
    public function calculateKcal() : int
    {
        try {
            $relation = self::BASIC_WEIGHT / $this->weight;
            $Kcal = round(($this->product->proteins * self::PROTEIN_KCAL
                    + $this->product->fats * self::FAT_KCAL
                    + $this->product->carbs * self::CARB_KCAL) / $relation);
        } catch (\Exception $e) {
            return 0;
        }

        return $Kcal;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
