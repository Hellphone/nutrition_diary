@extends('layout')

@section('title')
    Products
@endsection

@section('h1')
    Products
@endsection

@section('content')
    @if($links)
        <div class="links">
            @foreach($links as $link => $title)
                <a href="{{ $link }}">{{ $title }}</a>
            @endforeach
        </div>
    @endif
    @if($products->count())
        <ul class="table-like">
        @foreach($products as $product)
            <li>
                <form class="form__update" method="POST" action="/products/{{ $product->id }}">
                    @method('PATCH')
                    @csrf
                    <input type="text" class="input-editable" name="name" value="{{ $product->name }}">
                    <input type="text" class="input-editable" name="proteins" value="{{ $product->proteins }}">
                    <input type="text" class="input-editable" name="fats" value="{{ $product->fats }}">
                    <input type="text" class="input-editable" name="carbs" value="{{ $product->carbs }}">
                    <button type="submit">Update</button>
                </form>
                @include('errors')
                <a href="/products/{{ $product->id }}">{{ $product->name }}</a>:
                {{ $product->proteins }}|
                {{ $product->fats }}|
                {{ $product->carbs }}|
                <a href="/products/{{ $product->id }}/edit">Edit</a>
                <form class="form__update" method="POST" action="/products/{{ $product->id }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
        </ul>
    @endif
@endsection
