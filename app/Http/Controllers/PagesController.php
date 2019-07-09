<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

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

//    TODO: create a class for handling dates or look for something that Laravel can offer

    /**
     * @param $date
     * @return array
     */
    public function getDates($date)
    {
        if ($this->validateDate($date)) {
            $today = $this->getToday($date);
        } else {
            $today = date('Y-m-d');
        }
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

    /**
     * @param $date
     * @return bool
     */
    public function validateDate($date)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return true;
        } else {
            return false;
        }
    }
}
