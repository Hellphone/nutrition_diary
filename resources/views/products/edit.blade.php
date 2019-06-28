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
            <label for="title" class="label">Title</label>

            <div class="control">
                <input type="text" name="name" placeholder="Name" value="{{ $product->name }}">
            </div>
        </div>

        <div class="field">
            <label for="title" class="label">Белки</label>

            <div class="control">
                <input type="text" name="proteins" placeholder="Name" value="{{ $product->proteins }}">
            </div>
        </div>

        <div class="field">
            <label for="title" class="label">Жиры</label>

            <div class="control">
                <input type="text" name="fats" placeholder="Name" value="{{ $product->fats }}">
            </div>
        </div>

        <div class="field">
            <label for="title" class="label">Углеводы</label>

            <div class="control">
                <input type="text" name="carbs" placeholder="Name" value="{{ $product->carbs }}">
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
