<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $today = date('Y-m-d');
        $records = Record::where('date', 'like', $today)->get();

        return view('welcome', compact('records', 'today'));
    }
}
