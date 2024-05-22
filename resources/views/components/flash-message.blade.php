@if ($errors->any())
    <div class="mt-4 alert alert-danger alert-dismissible fade show position-absolute danger-flash" role="alert">
        <strong>Oops!</strong> There were some errors with your submission:
        <hr>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all alert elements
        const alerts = document.querySelectorAll('.alert-dismissible');

        // Set a timeout to hide each alert after 4 seconds
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.remove('show');
            }, 4000); // 4000 milliseconds = 4 seconds
        });
    });
</script>
