@if ($errors->any())
    <div class="notification is-danger">
        Errors:
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
