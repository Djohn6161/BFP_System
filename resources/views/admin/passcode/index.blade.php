@extends('layouts.user-template')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Passcodes</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Passcodes</h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addPasscodeModal">
                                    <i class="ti ti-plus"></i>
                                    Create
                                </button>
                                <x-passcode.create :category="$active"></x-passcode.create>
                            </div>
                            <div class="accordion accordion-flush table-responsive" id="accordionRankPersonnel">
                                <table class="table mb-0 align-middle w-100" id="operationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="fw-semibold mb-0">Passcode Action
                                            </th>
                                            <th class="fw-semibold mb-0">Passcode
                                            </th>
                                            <th class="fw-semibold mb-0 text-center">Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($passcodes as $passcode)
                                            <x-passcode.edit :passcode="$passcode"> </x-passcode.edit>
                                            <x-passcode.delete :passcode="$passcode"> </x-passcode.delete>
                                            <tr>
                                                <td>{{ $passcode->type }}</td>
                                                <td>{{ $passcode->action }}</td>
                                                <td>{{ $passcode->code }}</td>
                                                <td class="w-25 py-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="me-1">
                                                            <button class="btn btn-success w-100" data-bs-toggle="modal"
                                                                data-bs-target="#ediPasscodeModal{{ $passcode->id }}">
                                                                <i class="ti ti-pencil"></i>
                                                                Update
                                                            </button>
                                                        </div>
                                                        <div class="me-1">
                                                            <button class="btn btn-danger w-100" data-bs-toggle="modal"
                                                                data-bs-target="#deletePasscodeModal{{ $passcode->id }}">
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
@endsection
