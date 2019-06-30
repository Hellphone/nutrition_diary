@extends('layout')

@section('title')
    Create Record
@endsection

@section('h1')
    Create Record
@endsection

@section('content')
    <form method="POST" action="/records">
        @csrf

        <div class="field">
            <label for="product_id" class="label">Продукт</label>

            <div class="control">
                <input type="text" name="product_id" placeholder="Product" value="{{ old('product_id') }}">
            </div>
        </div>

        <div class="field">
            <label for="weight" class="label">Вес</label>

            <div class="control">
                <input type="text" name="weight" placeholder="Weight" value="{{ old('weight') }}">
            </div>
        </div>

        <div class="field">
            <label for="date" class="label">Дата</label>

            <div class="control">
                <input type="text" name="date" placeholder="Date" value="{{ old('date') }}">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit">Create Record</button>
            </div>
        </div>

    </form>

    <a href="/">Назад</a>

@endsection
