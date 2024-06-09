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
                                <h5 class="mb-0 text-light card-title fw-semibold">Available Passcodes</h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#generatePasscodeModal">
                                    <i class="ti ti-plus"></i>
                                    Generate
                                </button>
                                {{-- {{dd($users)}} --}}
                                <x-passcode.generate :category="$active" :users=$users></x-passcode.generate>
                            </div>
                            <div class="accordion accordion-flush table-responsive" id="accordionRankPersonnel">
                                <table class="table mb-0 align-middle w-100" id="operationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Created For</h6>
                                            </th>
                                            <th class="fw-semibold mb-0">CODE
                                            </th>
                                            <th class="fw-semibold mb-0">Date Created
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @php
                                            $sortedpasscodes = $passcodes->sortByDesc(function (
                                                $passcodes,
                                            ) {
                                                return \Carbon\Carbon::parse($passcodes->created_at);
                                            });
                                        @endphp
                                        @foreach ($sortedpasscodes as $passcode)
                                            <tr>
                                                <td>{{ $passcode->user->username }}</td>
                                                <td>{{ $passcode->code }}</td>
                                                <td>{{ $passcode->created_at }}</td>
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
