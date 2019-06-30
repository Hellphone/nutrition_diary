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
        <ul>
        @foreach($products as $product)
            <li>
                <a href="/products/{{ $product->id }}">{{ $product->name }}</a>:
                {{ $product->proteins }}|
                {{ $product->fats }}|
                {{ $product->carbs }}|
                <a href="/products/{{ $product->id }}/edit">Edit</a>
                <form method="POST" action="/products/{{ $product->id }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
        </ul>
    @endif
@endsection
