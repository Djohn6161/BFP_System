<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        {{-- <x-flash-message></x-flash-message> --}}

        <div class="col-lg-12">
            <!-- Monthly Earnings -->

            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addOccupancyModal">Create</button>
                    <x-occupancy.create :category="$active"></x-occupancy.create>
                </div>
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                  </button> --}}
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 text-capitalize">
                                {{-- {{ $active != 'occupancy' ? $active : 'All' }} Investigation Reports</h5> --}}
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Occupancy Name</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($occupancy_names as $occupancyName)
                                        
                                        <x-occupancy.edit :occupancyName=$occupancyName></x-occupancy.edit>
                                        <x-occupancy.delete :occupancyName=$occupancyName></x-occupancy.delete>

                                            {{-- <x-reports.view-modal :report=$investigation></x-reports.view-modal> --}}
                                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                                            <tr>
                                                {{-- {{dd($occupancies)}} --}}
                                                <td class="border-bottom-0">
                                                    {{ $occupancyName->name}}
                                                </td>
                                                
                                                <td class="border-bottom-0">
                                                    <button class="btn btn-success w-100 mb-1" data-bs-toggle="modal" data-bs-target="#updateOccupancyModal{{ $occupancyName->id }}">
                                                        Update
                                                        <i class="ti ti-pencil"></i>
                                                    </button>
                                                   
                                                    <br>
                                                    <button class="btn btn-danger w-100 mb-1" data-bs-toggle="modal" data-bs-target="#deleteOccupancyModal{{ $occupancyName->id }}">
                                                        Delete
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                   
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
            {{-- @include('partials.investigationScript') --}}
        @endsection
