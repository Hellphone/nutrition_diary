@extends('layout')

@section('title')
    Record #{{ $record->id }}
@endsection

@section('h1')
    Record #{{ $record->id }}
@endsection

@section('content')
    @if($links)
        <div class="links">
            @foreach($links as $link => $title)
                <a href="{{ $link }}">{{ $title }}</a>
            @endforeach
        </div>
    @endif
    <p>{{ $record->product->name }}</p>
    <p>{{ $record->weight }} г.</p>
    <p>{{ $record->date }}</p>

    <a href="/">Назад</a>

@endsection
