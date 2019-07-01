<?php

namespace App\Http\Controllers;

use App\Product;
use App\Record;
use Illuminate\Http\Request;

/**
 * Class RecordsController
 * @package App\Http\Controllers
 */
class RecordsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $today = date('Y-m-d');
        $records = Record::where('date', 'like', $today)->get();

        return view('welcome', compact('products', 'records', 'today'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $products = Product::all();

        return view('records.create', compact('products'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $attributes = request()->validate([
            'product_id' => ['required'],
            'weight' => ['required', 'min:1'],
            'date' => ['required', 'date_format:Y-m-d']
        ]);

        Record::create($attributes);

        return redirect('/');
    }

    /**
     * @param Record $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Record $record)
    {
        $links = [
            "/records" => "All records",
            "/records/create" => "Create",
            "/records/$record->id" => "Edit",
            "/records/$record->id" => "Delete",
        ];

        return view('records.show', compact('record', 'links'));
    }

    /**
     * @param Record $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Record $record)
    {
        $products = Product::all();

        return view('records.edit', compact('record', 'products'));
    }

    /**
     * @param Record $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Record $record)
    {
        $attributes = request()->validate([
            'product_id' => ['required'],
            'weight' => ['required', 'min:1'],
            'date' => ['required', 'date_format:Y-m-d']
        ]);

        $record->update($attributes);

        return redirect('/');
    }

    /**
     * @param Record $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return redirect('/');
    }

    /**
     * @param Record $record
     * @return float|int
     */
    public function calculateKcal(Record $record) : int
    {
        return $record->calculateKcal();
    }
}
