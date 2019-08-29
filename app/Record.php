<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'product_id',
        'weight',
        'date',
    ];

    private const BASIC_WEIGHT = 100;

    private const PROTEIN_KCAL = 4;
    private const FAT_KCAL = 9;
    private const CARB_KCAL = 4;

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


    public static function calculateKcalForADay($date) : int
    {
        try {
            $records = Record::where('date', 'like', $date)->where('owner_id', 'like', auth()->id())->get();
            $sum = 0;
            foreach ($records as $record) {
                $sum += $record->calculateKcal();
            }
        } catch (\Exception $e) {
            return 0;
        }

        return $sum;
    }

    public static function calculateMacrosForADay($date, $type) : int
    {
        try {
            $records = Record::where('date', 'like', $date)->where('owner_id', 'like', auth()->id())->get();
            $sum = 0;
            foreach ($records as $record) {
                $sum += $record->product->$type;
            }
        } catch (\Exception $e) {
            return 0;
        }

        return $sum;
    }

    public static function calculateWeightForADay($date) : int
    {
        try {
            $records = Record::where('date', 'like', $date)->where('owner_id', 'like', auth()->id())->get();
            $sum = 0;
            foreach ($records as $record) {
                $sum += $record->weight;
            }
        } catch (\Exception $e) {
            return 0;
        }

        return $sum;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
