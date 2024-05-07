@extends('layouts.user-template')

@section('content')
    <div class="container-fluid">
        <!-- Row 1 -->
        <div class="col-lg-12">
            <!-- Monthly Earnings -->
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRankModal">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Add Rank</span>
                    </button>

                </div>
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body p-4">

                            <!-- Display Total Personnel -->
                            <h5 class="fw-semibold mb-4">BFP - Ranks
                                <span class=" ms-3 badge rounded-pill bg-secondary"></span>
                            </h5>

                            <!-- Accordion for Ranks -->
                            <div class="accordion accordion-flush" id="accordionRankPersonnel">
                                <table class="table mb-0 align-middle w-100" id="rankTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Slug</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
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
                                                <td class="border-bottom-0">
                                                    <button class="btn btn-success w-100 mb-1" data-bs-toggle="modal" data-bs-target="#editRankModal{{ $rank->id }}">Update</button>
                                                    <br>
                                                    <span>
                                                        <i class="ti ti-trash"></i>
                                                    </span>
                                                    <button data-bs-toggle="modal" data-bs-target="#deleteRankModal{{ $rank->id }}" class="btn btn-danger w-100 mb-1">Delete</button>
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
