@extends('layout')

@section('title')
    Product {{ $product->name }} Edit
@endsection

@section('h1')
    Product {{ $product->name }} Edit
@endsection

@section('content')
    <form method="POST" action="/products/{{ $product->id }}">
        @method('PATCH')
        @csrf

        <div class="field">
            <label for="name" class="label">Название</label>

            <div class="control">
                <input type="text" name="name" placeholder="Name" value="{{ $product->name }}">
            </div>
        </div>

        <div class="field">
            <label for="proteins" class="label">Белки</label>

            <div class="control">
                <input type="text" name="proteins" placeholder="Proteins" value="{{ $product->proteins }}">
            </div>
        </div>

        <div class="field">
            <label for="fats" class="label">Жиры</label>

            <div class="control">
                <input type="text" name="fats" placeholder="Fats" value="{{ $product->fats }}">
            </div>
        </div>

        <div class="field">
            <label for="carbs" class="label">Углеводы</label>

            <div class="control">
                <input type="text" name="carbs" placeholder="Carbs" value="{{ $product->carbs }}">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit">Update Product</button>
            </div>
        </div>

    </form>

    <form method="POST" action="/products/{{ $product->id }}">
        @method('DELETE')
        @csrf
        <div class="field">
            <div class="control">
                <button type="submit">Delete Product</button>
            </div>
        </div>
    </form>

    <a href="/products">Назад</a>

@endsection
