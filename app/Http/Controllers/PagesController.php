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
     * @param null $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($date = null)
    {
        $dates = $this->getDates($date);

        $records = Record::where('date', 'like', $dates['today'])->get();
        $todaysKcal = Record::calculateKcalForADay($dates['today']);

        if ($date >= date('Y-m-d')) {
            return redirect('/');
        }

        return view('welcome', compact(
            'products',
            'records',
            'dates',
            'todaysKcal'
        ));
    }

    /**
     * @param $date
     * @return array
     */
    public function getDates($date)
    {
        $today = $this->getToday($date);
        $yesterday = $this->getYesterday($today);
        $tomorrow = $this->getTomorrow($today);

        $dates = compact('yesterday', 'today', 'tomorrow');

        return $dates;
    }

    /**
     * @param $date
     * @return false|string
     */
    public function getToday($date)
    {
        if ($date == null || $date > date('Y-m-d')) {
            return date('Y-m-d');
        } else {
            return $date;
        }
    }

    /**
     * @param $date
     * @return false|string
     */
    public function getYesterday($date)
    {
        if ($date == null) {
            $date = date('Y-m-d');
        }

        $unixTime = strtotime($date);
        $yesterday = date('Y-m-d', $unixTime - 60 * 60 * 24);

        return $yesterday;
    }

    /**
     * @param $date
     * @return false|string|null
     */
    public function getTomorrow($date)
    {
        if ($date == date('Y-m-d')) {
            $tomorrow = null;
        } else {
            $unixTime = strtotime($date);
            $tomorrow = date('Y-m-d', $unixTime + 60 * 60 * 24);
        }

        return $tomorrow;
    }
}
