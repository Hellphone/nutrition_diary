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
            <label for="title" class="label">Название</label>

            <div class="control">
                <input type="text" name="name" placeholder="Name">
            </div>
        </div>

        <div class="field">
            <label for="title" class="label">Белки</label>

            <div class="control">
                <input type="text" name="proteins" placeholder="Proteins">
            </div>
        </div>

        <div class="field">
            <label for="title" class="label">Жиры</label>

            <div class="control">
                <input type="text" name="fats" placeholder="Fats">
            </div>
        </div>

        <div class="field">
            <label for="title" class="label">Углеводы</label>

            <div class="control">
                <input type="text" name="carbs" placeholder="Carbs">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit">Create Product</button>
            </div>
        </div>

    </form>
@endsection
