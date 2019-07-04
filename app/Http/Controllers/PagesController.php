<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

/**
 * Class PagesController
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home($date = null)
    {
        if ($date == null) {
            $date = date('Y-m-d');
            $yesterday = date('Y-m-d', time() - 60 * 60 * 24);
            $tomorrow = null;
        } else {
            
        }
        $records = Record::where('date', 'like', $date)->get();
        $todaysKcal = Record::calculateKcalForADay($date);

        return view('welcome', compact(
            'products',
            'records',
            'date',
            'yesterday',
            'tomorrow',
            'todaysKcal'
        ));
    }
}
