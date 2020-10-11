@if ($errors->any())
    <div class="text-error-color border border-error-color bg-red-100 padding-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="my-5">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
