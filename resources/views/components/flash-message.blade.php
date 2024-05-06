@if ($errors->any())
    <div class="mt-4 py-0 alert alert-danger alert-dismissible fade show position-absolute danger-flash" role="alert">
        <strong>Oops!</strong> There were some errors with your submission:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-info alert-dismissible fade show flast-pos text-center position-absolute" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-absolute flast-pos text-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
