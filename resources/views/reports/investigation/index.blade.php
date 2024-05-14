<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold text-capitalize">
                                    {{ $active != 'investigation' ? $active : 'All' }} Investigation Reports
                                </h5>
                                @if ($user->privilege == 'IC' || $user->privilege == 'All')
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#chooseInvestigation">
                                        <i class="ti ti-plus"></i>
                                        Create
                                    </button>
                                    <x-reports.create-investigation :spots=$spots></x-reports.create-investigation>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="allInvestigation">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">For</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Subject</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            @if ($user->privilege == 'IC' || $user->privilege == 'All')
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($investigations as $investigation)
                                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                                            <tr>
                                                {{-- {{dd($investigation)}} --}}
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->for }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $investigation->subject }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($investigation->date)->format('F j, Y') }}
                                                    </p>
                                                </td>
                                                @if ($investigation->minimal != null)
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">Minimal</p>
                                                    </td>
                                                @elseif($investigation->spot != null)
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">Spot</p>
                                                    </td>
                                                @elseif($investigation->progress != null)
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">Progress</p>
                                                    </td>
                                                @elseif($investigation->final != null)
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">Final</p>
                                                    </td>
                                                @endif
                                                {{-- {{dd($investigation->minimal)}} --}}
                                                @if ($user->privilege == 'IC' || $user->privilege == 'All')
                                                    @if ($investigation->minimal != null)
                                                        @php
                                                            $investigation = $investigation->minimal;
                                                        @endphp
                                                        <td class="border-bottom-0">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewMinimalModal{{ $investigation->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-minimal
                                                                :investigation=$investigation></x-reports.Investigation.view-minimal>
                                                            <a href="{{ route('investigation.minimal.edit', ['minimal' => $investigation->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i>
                                                                Update</a>

                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigation->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                            <x-reports.investigation.investigation-delete :type="'minimal'"
                                                                :investigation=$investigation></x-reports.investigation.investigation-delete>
                                                        </td>
                                                    @elseif($investigation->spot != null)
                                                        @php
                                                            $investigation = $investigation->spot;
                                                        @endphp
                                                        <td class="border-bottom-0">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewSpotModal{{ $investigation->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-spot
                                                                :investigation=$investigation></x-reports.Investigation.view-spot>

                                                            <a href="{{ route('investigation.spot.edit', ['spot' => $investigation->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i>
                                                                Update</a>
                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigation->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                            <x-reports.investigation.investigation-delete :type="'spot'"
                                                                :investigation=$investigation></x-reports.investigation.investigation-delete>
                                                        </td>
                                                    @elseif($investigation->progress != null)
                                                        @php
                                                            $investigation = $investigation->progress;
                                                        @endphp
                                                        <td class="border-bottom-0">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewProgressModal{{ $investigation->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-progress
                                                                :investigation=$investigation></x-reports.Investigation.view-progress>

                                                            <a href="{{ route('investigation.progress.edit', ['progress' => $investigation->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i>
                                                                Update</a>
                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigation->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                            <x-reports.investigation.investigation-delete :type="'progress'"
                                                                :investigation=$investigation></x-reports.investigation.investigation-delete>
                                                        </td>
                                                    @elseif($investigation->final != null)
                                                        @php
                                                            $investigation = $investigation->final;
                                                        @endphp
                                                        <td class="border-bottom-0">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewFinalModal{{ $investigation->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-final
                                                                :investigation=$investigation></x-reports.Investigation.view-final>
                                                            <x-reports.investigation.investigation-delete :type="'final'"
                                                                :investigation=$investigation></x-reports.investigation.investigation-delete>
                                                            <a href="{{ route('investigation.final.edit', ['final' => $investigation->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i>
                                                                Update</a>
                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigation->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                        </td>
                                                    @endif
                                                @endif

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
