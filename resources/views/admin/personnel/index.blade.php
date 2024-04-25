@extends('layouts.user-template')

@section('content')
<div class="container-fluid">
    <!-- Row 1 -->
    <div class="col-lg-12">
        <!-- Monthly Earnings -->
        <div class="row">
            <div class="col d-flex justify-content-end mb-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPersonnelModal">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Add Personnel</span>
                </button>
            </div>
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <!-- Retrieve Personnel Data and Process -->
                        @php
                        // Sample personnel data (replace this with actual data retrieval)
                        $personnelData = [
                        ['name' => 'Juan Luna', 'rank' => 'Fire Officer 1'],
                        ['name' => 'Maria Garcia', 'rank' => 'Fire Officer 2'],
                        ['name' => 'Maria Pontillas', 'rank' => 'Fire Officer 2'],
                        ['name' => 'Gina Pontillas', 'rank' => 'Fire Officer 2'],
                        // Add more personnel data as needed
                        ];

                        // Process data to count personnel in each rank
                        $personnelCountByRank = [];
                        foreach ($personnelData as $person) {
                            $rank = $person['rank'];
                            if (!isset($personnelCountByRank[$rank])) {
                                $personnelCountByRank[$rank] = 0;
                            }
                            $personnelCountByRank[$rank]++;
                        }
                        @endphp

                        <!-- Display Total Personnel -->
                        <h5 class="fw-semibold mb-4">BFP - Personnel
                            <span class=" ms-3 badge rounded-pill bg-secondary">{{ count($personnelData) }}</span>
                        </h5>

                        <!-- Accordion for Ranks -->
                        <div class="accordion accordion-flush" id="accordionRankPersonnel">
                            @foreach ($personnelCountByRank as $rank => $count)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $loop->index + 1 }}" aria-expanded="false"
                                        aria-controls="flush-collapse{{ $loop->index + 1 }}">
                                        {{ $rank }}
                                        <span class="ms-3 badge rounded-pill bg-secondary">{{ $count }}</span>
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $loop->index + 1 }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionRankPersonnel">
                                    <div class="row row-cols-1 row-cols-md-4 g-4 p-3 mt-2">
                                        @foreach ($personnelData as $person)
                                        @if ($person['rank'] === $rank)
                                        <div class="card justify-content-center m-2"
                                            style="width: calc(25% - 1rem); p-1;">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#viewPersonnelModal">
                                                <div class="col py-2">
                                                    <!-- Display Personnel Details -->
                                                    <img src="{{ asset('assets/images/logos/tin.jpg') }}"
                                                        class="card-img-top object-fit-cover rounded" height="300"
                                                        alt="personnel picture">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center fw-bold fs-5">
                                                            {{ $person['name'] }}</h5>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-personnel.view :category="$active"> </x-personnel.view>
<x-personnel.add :category="$active"> </x-personnel.add>
@endsection
