@extends('layout')

@section('title')
    Create Product
@endsection

@section('h1')
    Create Product
@endsection

@section('content')
    <form method="POST" action="/products">
        @csrf

        <div class="field">
            <label for="name" class="label">Название</label>

            <div class="control">
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="field">
            <label for="proteins" class="label">Белки</label>

            <div class="control">
                <input type="text" name="proteins" placeholder="Proteins" value="{{ old('proteins') }}">
            </div>
        </div>

        <div class="field">
            <label for="fats" class="label">Жиры</label>

            <div class="control">
                <input type="text" name="fats" placeholder="Fats" value="{{ old('fats') }}">
            </div>
        </div>

        <div class="field">
            <label for="carbs" class="label">Углеводы</label>

            <div class="control">
                <input type="text" name="carbs" placeholder="Carbs" value="{{ old('carbs') }}">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit">Create Product</button>
            </div>
        </div>

    </form>

    @include('errors')

    <a href="/products">Назад</a>

@endsection
