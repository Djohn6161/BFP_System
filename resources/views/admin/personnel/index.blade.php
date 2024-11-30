@extends('layouts.user-template')

@section('content')

    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Personnel</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Personnel</h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addPersonnelModal">
                                    <i class="ti ti-plus"></i>
                                    Add Personnel
                                </button>
                                <x-personnel.add :category="$active" :ranks="$ranks" :maritals="$maritals" :genders="$genders" :designations="$designations">
                                </x-personnel.add>
                            </div>

                            <!-- Accordion for Ranks -->
                            <div class="accordion accordion-flush px-4" id="accordionRankPersonnel">
                                @foreach ($ranks as $rank)
                                    <?php $count = 0; ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $loop->index + 1 }}" aria-expanded="false"
                                                aria-controls="flush-collapse{{ $loop->index + 1 }}">
                                                {{ $rank->slug }} - {{ $rank->name }}
                                                @foreach ($personnels as $personnel)
                                                    @if ($personnel->ranks_id == $rank->id)
                                                        <?php $count++; ?>
                                                    @endif
                                                @endforeach
                                                <span
                                                    class="ms-3 badge rounded-pill bg-secondary text-dark">{{ $count }}</span>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $loop->index + 1 }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionRankPersonnel">
                                            <div class="row row-cols-1 row-cols-md-4 g-4 p-3 mt-2">
                                                @foreach ($personnels as $personnel)
                                                    @if ($personnel->ranks_id == $rank->id)
                                                        <div class="card justify-content-center m-2"
                                                        style="width: calc(25% - 1rem); padding: 0.25rem;">
                                                            <a href="{{ route('admin.personnel.view', $personnel->id) }}">
                                                                <div class="col py-2">
                                                                    <img src="{{ asset('assets/images/personnel_images/'.$personnel->picture) }}"
                                                                        class="card-img-top object-fit-cover rounded"
                                                                        height="300" alt="personnel picture">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-center fw-bold fs-5">
                                                                            {{ $personnel->first_name }}
                                                                            {{ $personnel->last_name }}</h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <?php $count = 0; ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseunk" aria-expanded="false"
                                            aria-controls="flush-collapseunk">
                                            Unknown Personnel
                                            @foreach ($personnels as $personnel)
                                                @if ($personnel->ranks_id == null)
                                                    <?php $count++; ?>
                                                @endif
                                            @endforeach
                                            <span
                                                class="ms-3 badge rounded-pill bg-secondary text-dark">{{ $count }}</span>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseunk" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionRankPersonnel">
                                        <div class="row row-cols-1 row-cols-md-4 g-4 p-3 mt-2">
                                            
                                            @foreach ($personnels->whereNull('ranks_id') as $personnel)
                                            {{-- {{dd($personnels->whereNull('ranks_id'))}} --}}
                                                    <div class="card justify-content-center m-2"
                                                    style="width: calc(25% - 1rem); padding: 0.25rem;">
                                                        <a href="{{ route('admin.personnel.view', $personnel->id) }}">
                                                            <div class="col py-2">
                                                                <img src="{{ asset('assets/images/personnel_images/'.$personnel->picture) }}"
                                                                    class="card-img-top object-fit-cover rounded"
                                                                    height="300" alt="personnel picture">
                                                                <div class="card-body">
                                                                    <h5 class="card-title text-center fw-bold fs-5">
                                                                        {{ $personnel->first_name }}
                                                                        {{ $personnel->last_name }}</h5>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



   
    {{-- <x-personnel.preview :category="$active"> </x-personnel.preview> --}}
@endsection
