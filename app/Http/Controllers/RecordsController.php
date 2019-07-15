<?php

namespace App\Http\Controllers;

use App\Product;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class RecordsController
 * @package App\Http\Controllers
 */
class RecordsController extends Controller
{
    /**
     * @param null $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $date = Input::get('date', date('Y-m-d'));
        $products = Product::where('owner_id', 'like', auth()->id())->get();

        return view('records.create', compact('products', 'date'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $attributes = $this->validateRecord();
        $attributes['owner_id'] = auth()->id();

        Record::create($attributes);

        return redirect('/');
    }

    /**
     * @param Record $record
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Record $record)
    {
        $this->authorize('update', $record);

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
        $this->authorize('update', $record);

        $products = Product::all();

        return view('records.edit', compact('record', 'products'));
    }

    /**
     * @param Record $record
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Record $record)
    {
        $attributes = $this->validateRecord();
        $attributes['owner_id'] = auth()->id();

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
     * @return mixed
     */
    public function validateRecord()
    {
        return request()->validate([
            'product_id' => ['required'],
            'weight' => ['required', 'min:1'],
            'date' => ['required', 'date_format:Y-m-d']
        ]);
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
