@extends('layouts.user-template')

@section('content')
    {{-- <div class="container-fluid">
        <!-- Row 1 -->
        <div class="col-lg-12">
            <!-- Monthly Earnings -->
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRankModal">
                        <span>
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="hide-menu">Add Rank</span>
                    </button>

                </div>
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body p-4">

                            <!-- Display Total Personnel -->
                            <h5 class="card-title fw-semibold mb-4 p-3 rounded bg-gradient-blue text-light">
                                Ranks
                                <span class=" ms-3 badge rounded-pill bg-secondary"></span>
                            </h5>

                            
                            <!-- Accordion for Ranks --> --}}

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Ranks</h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addRankModal">
                                    <i class="ti ti-plus"></i>
                                    Create
                                </button>
                                <x-truck.create :category="$active"></x-truck.create>
                            </div>
                            <div class="accordion accordion-flush table-responsive" id="accordionRankPersonnel">
                                <table class="table mb-0 align-middle w-100" id="operationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Slug</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 text-center">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ranks as $rank)
                                            <x-rank.edit :rank="$rank"> </x-rank.edit>
                                            <x-rank.delete :rank="$rank"> </x-rank.delete>
                                            <tr>
                                                <td>{{ $rank->name }}</td>
                                                <td>{{ $rank->slug }}</td>
                                                <td class="w-25 py-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="me-1">
                                                            <button class="btn btn-success w-100 mb-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editRankModal{{ $rank->id }}">
                                                                <i class="ti ti-pencil"></i>
                                                                Update
                                                                
                                                            </button>
                                                        </div>
                                                        <div class="me-1">
                                                            <button class="btn btn-danger w-100 mb-1" data-bs-toggle="modal"
                                                                data-bs-target="#deleteRankModal{{ $rank->id }}">
                                                                <i class="ti ti-trash"></i>
                                                                Delete
                                                                
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-rank.create :category="$active"> </x-rank.create>
@endsection
