@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 text-center animated-alert" role="alert" style="z-index: 9999;">
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
    <div class="alert alert-info alert-dismissible fade show position-fixed bottom-0 end-0 text-center animated-alert" role="alert" style="z-index: 9999;">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 text-center animated-alert" role="alert" style="z-index: 9999;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Select all alert elements
    const alerts = document.querySelectorAll('.animated-alert');

    // Set a timeout to remove the 'show' class after 4 seconds
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.remove('show');
        }, 4000); // 4000 milliseconds = 4 seconds

        // Add additional animations
        alert.addEventListener('mouseenter', () => {
            alert.classList.add('animate__animated', 'animate__pulse');
        });

        alert.addEventListener('mouseleave', () => {
            alert.classList.remove('animate__animated', 'animate__pulse');
        });
    });
});

</script>


<style>
   .animated-alert {
    animation: slideInDown 0.5s ease-in-out;
    border-left: 10px solid; /* Add a default border */
}

.alert-danger {
    border-color: #f44336; /* Red */
}

.alert-info {
    border-color: #2196f3; /* Blue */
}

.alert-success {
    border-color: #4caf50; /* Green */
}

.alert-warning {
    border-color: #ff9800; /* Orange */
}

.alert-default {
    border-color: #bdbdbd; /* Gray */
}

@keyframes slideInDown {
    0% {
        transform: translateY(-100%);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}


</style>