<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Trucks</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Trucks</h5>
                                @if ($user->privilege == 'configuration_chief')
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#addTruckModal">
                                        <i class="ti ti-plus"></i>
                                        Create
                                    </button>
                                    <x-truck.create :category="$active"></x-truck.create>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="trucksTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>#</th>
                                            <th>Truck Name</th>
                                            <th>Plate Number</th>
                                            <th>Status</th>
                                            @if ($user->privilege == 'configuration_chief')
                                                <th class="border-bottom-0 text-center">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($trucks as $truck)
                                            <x-truck.edit :truck=$truck></x-truck.edit>
                                            <x-truck.delete :truck=$truck></x-truck.delete>
                                            <tr>
                                                {{-- {{dd($occupancies)}} --}}
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    {{ $truck->name }}
                                                </td>
                                                <td>
                                                    {{ $truck->plate_num }}
                                                </td>
                                                <td>
                                                    {{ $truck->status }}
                                                </td>
                                                @if ($user->privilege == 'configuration_chief')
                                                    <td class="w-25 py-2">
                                                        <div class="d-flex flex-row">
                                                            <div class="me-1">
                                                                <button class="btn btn-success w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#editTruckModal{{ $truck->id }}">
                                                                    <i class="ti ti-pencil"></i>
                                                                    Update

                                                                </button>
                                                            </div>
                                                            {{-- {{dd(count($truck->minimalEngine ?? []))}} --}}
                                                            {{-- @if (count($truck->responses ?? []) != 0 || count($truck->minimalEngine ?? []) != 0)
                                                                <div class="me-1">
                                                                    <button disabled class="btn btn-secondary"
                                                                        data-bs-toggle="modal">
                                                                        <i class="ti ti-x"></i>
                                                                        Invalid
                                                                    </button>
                                                                </div>
                                                            @else --}}
                                                                <div class="me-1">
                                                                    <button class="btn btn-danger w-100"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteTruckModal{{ $truck->id }}">
                                                                        <i class="ti ti-trash"></i>
                                                                        Delete
                                                                    </button>
                                                                </div>
                                                            {{-- @endif --}}
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
        @endsection
