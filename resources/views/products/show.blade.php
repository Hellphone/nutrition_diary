@extends('layout')

@section('title')
    {{ $product->name }}
@endsection

@section('h1')
    {{ $product->name }}
@endsection

@section('content')
    @if($links)
        <div class="links">
            @foreach($links as $link => $title)
                <a href="{{ $link }}">{{ $title }}</a>
            @endforeach
        </div>
    @endif
    <p>Белки: {{ $product->proteins }}</p>
    <p>Жиры: {{ $product->fats }}</p>
    <p>Углеводы: {{ $product->carbs }}</p>

@endsection
