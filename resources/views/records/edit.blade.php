@extends('layout')

@section('title')
    Record #{{ $record->id }} Edit
@endsection

@section('h1')
    Record #{{ $record->id }} Edit
@endsection

@section('pagespecificscripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script src="{{ URL::asset('js/script.js') }}"></script>
@endsection

@section('content')
    <form method="POST" action="/records/{{ $record->id }}">
        @method('PATCH')
        @csrf

        <div class="field">
            <label for="product_id" class="label">Продукт</label>

            <div class="control">
                <select class="select2-basic-single" name="product_id">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id == $record->product_id) selected @endif >{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="field">
            <label for="weight" class="label">Вес</label>

            <div class="control">
                <input type="text" name="weight" placeholder="Weight" value="{{ $record->weight }}">
            </div>
        </div>

        <div class="field">
            <label for="date" class="label">Дата</label>

            <div class="control">
                <input type="date" name="date" placeholder="Date" value="{{ $record->date }}">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit">Update Record</button>
            </div>
        </div>

    </form>

    @include('errors')

    <form method="POST" action="/records/{{ $record->id }}">
        @method('DELETE')
        @csrf
        <div class="field">
            <div class="control">
                <button type="submit">Delete Record</button>
            </div>
        </div>
    </form>

    <a href="/">Назад</a>

@endsection
