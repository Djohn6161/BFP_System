
@extends('layouts.user-template')
@section('content')
   

    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Activities</a></li>
                <li class="breadcrumb-item"><a href="">Trash</a></li>
                <li class="breadcrumb-item active" aria-current="page">Investigation Trash</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Investigation Trash</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="trashInvestigationTable">
                                    <thead class="text-dark fs-4">
                                        <tr class="text-center">
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Deleted at</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">ID</h6>
                                            </th>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">For</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Subject</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($investigations as $investigation)
                                            <x-trash.investigation.restore
                                                :investigation=$investigation></x-trash.investigation.restore>
                                            <tr class="text-center">
                                                {{-- {{dd($investigation)}} --}}
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ \Carbon\Carbon::parse($investigation->deleted_at)->format('F j, Y') }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->for }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $investigation->subject }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#restoreTrashInvestigationModal{{ $investigation->id }}"
                                                        class="btn btn-success w-100 mb-1">Restore</button>
                                                    <br>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteTrashInvestigationModal{{ $investigation->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1">Delete</button>
                                                    <x-trash.investigation.delete
                                                        :investigation=$investigation></x-trash.investigation.delete>
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
            @include('partials.investigationScript')
        @endsection
