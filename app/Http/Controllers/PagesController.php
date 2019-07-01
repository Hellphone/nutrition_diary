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
    public function home()
    {
        $date = date('Y-m-d');
        $records = Record::where('date', 'like', $date)->get();

        return view('welcome', compact('records', 'date'));
    }
}
