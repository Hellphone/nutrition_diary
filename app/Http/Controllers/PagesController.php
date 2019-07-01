<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $date = date('Y-m-d');
        $records = Record::where('date', 'like', $date)->get();

        return view('welcome', compact('records', 'date'));
    }
}
