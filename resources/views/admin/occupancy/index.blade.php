@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Occupancies</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Occupancy
                                    Names</h5>
                                @if ($user->privilege == 'configuration_chief')
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#addOccupancyModal">
                                        <i class="ti ti-plus"></i>
                                        Create
                                    </button>
                                    <x-occupancy.create :category="$active"></x-occupancy.create>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="barangayTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                #
                                            </th>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                Occupancy Name
                                            </th>
                                            @if ($user->privilege == 'configuration_chief')
                                                <th class="border-bottom-0 text-center" style="max-width:10%">
                                                    Action
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($occupancy_names as $occupancyName)
                                            <x-occupancy.edit :occupancyName=$occupancyName></x-occupancy.edit>
                                            <x-occupancy.delete :occupancyName=$occupancyName></x-occupancy.delete>


                                            <tr>

                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    {{ $occupancyName->name }}
                                                </td>
                                                @if ($user->privilege == 'configuration_chief')
                                                    <td class="w-25 py-2">
                                                        <div class="d-flex flex-row">
                                                            <div class="me-1">
                                                                <button class="btn btn-success w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#updateOccupancyModal{{ $occupancyName->id }}">
                                                                    <i class="ti ti-pencil"></i>
                                                                    Update

                                                                </button>
                                                            </div>
                                                            <div class="me-1">
                                                                <button class="btn btn-danger w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteOccupancyModal{{ $occupancyName->id }}">
                                                                    <i class="ti ti-trash"></i>
                                                                    Delete

                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
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
