@extends('layouts.user-template')
@section('content')

<style>
.earth-spinning {
    perspective: 1000px;
}

.spinning-logo {
    animation: spin 5s linear infinite;
    transform-origin: 50% 50%;
}

@keyframes spin {
    from {
        transform: rotateY(0deg);
    }
    to {
        transform: rotateY(70deg);
    }
}
</style>
    <div class="container-fluid position-relative py-0" style="top: 10vh">
        <!--  Row 1 -->
        <div class="d-flex justify-content-center">
            <div class="col-lg-12 mb-3 mt-2">
                <!-- Monthly Earnings -->
                <div class="row">
                    <div class="col text-center">
                        <div class="earth-spinning">
                            <img src="../assets/images/logos/BFP_Ligao_logo.png" width="170" alt="" class="spinning-logo">
                        </div>
                        <h1>BFP Ligao City</h1>
                    </div>

                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-auto">
                        <a href="{{ route('operation.index') }}" type="button"
                            class="btn btn-lg btn-secondary me-2 btn-width">Operation</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('investigation.index') }}" type="button"
                            class="btn btn-lg btn-outline-secondary btn-width">Investigation</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <h4 class="mb-3">Fire Incidents</h4>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card border-start border-primary border-5 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="mb-1 fw-bold text-primary">Total Fire Incident</p>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h5 class="mb-0 fw-semibold">{{ count($afor ?? []) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto px-2">
                                <i class="ti ti-layout-dashboard custom-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($occupancies as $occupancy)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-start border-danger border-5 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col px-0">
                                    <p class="mb-1 fw-bold text-dark">{{ $occupancy->name }}</p>
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h5 class="mb-0 fw-semibold">
                                                {{ count($afor->where('occupancy_specify', $occupancy->name) ?? []) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto px-0">
                                    <i class="ti ti-flame custom-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
