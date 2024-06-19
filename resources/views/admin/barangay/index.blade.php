@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Barangay</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">
                                    Barangay
                                </h5>
                                @if ($user->privilege == 'configuration_chief')
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#addBarangayModal">
                                        <i class="ti ti-plus"></i>
                                        Create
                                    </button>
                                    <x-barangay.create :category="$active"></x-barangay.create>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="barangayTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">Name</th>
                                            <th class="border-bottom-0">Unit</th>
                                            @if ($user->privilege == 'configuration_chief')
                                                <th class="border-bottom-0 text-center">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($barangays as $barangay)
                                            <x-barangay.edit :barangay=$barangay></x-barangay.edit>
                                            <x-barangay.delete :barangay=$barangay></x-barangay.delete>

                                            {{-- <x-reports.view-modal :report=$investigation></x-reports.view-modal> --}}
                                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                                            <tr>
                                                {{-- {{dd($occupancies)}} --}}
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    {{ $barangay->name }}
                                                </td>
                                                <td>
                                                    {{ $barangay->unit }}
                                                </td>
                                                @if ($user->privilege == 'configuration_chief')
                                                    <td class="w-25 py-2">
                                                        <div class="d-flex flex-row">
                                                            <div class="me-1">
                                                                <button class="btn btn-success w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#editBarangayModal{{ $barangay->id }}">
                                                                    <i class="ti ti-pencil"></i>
                                                                    Update

                                                                </button>
                                                            </div>
                                                            <div class="me-1">
                                                                <button class="btn btn-danger w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteBarangayModal{{ $barangay->id }}">
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
