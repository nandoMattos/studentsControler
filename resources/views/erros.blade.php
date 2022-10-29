@if ($errors->any())
    <div class="mx-5 mb-3 mt-4 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif