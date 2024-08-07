@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Investigation Reports</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold text-capitalize">
                                    {{ $active != 'investigation' ? $active : 'All' }} Investigation Reports
                                </h5>
                                @if ($user->privilege == 'investigation_admin_chief' || $user->privilege == 'investigation_clerk')
                                    <div class="d-flex column-gap-2">
                                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                            data-bs-target="#importInvestigation">
                                            <i class="ti ti-file-export"></i>
                                            Import
                                        </button>
                                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                            data-bs-target="#exportInvestigation">
                                            <i class="ti ti-file-export"></i>
                                            Export
                                        </button>
                                        <x-reports.export></x-reports.export>
                                        <x-reports.import></x-reports.import>
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#chooseInvestigation">
                                            <i class="ti ti-plus"></i>
                                            Create
                                        </button>
                                        <x-reports.create-investigation :spots=$spots
                                            :afors=$afors></x-reports.create-investigation>
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="allInvestigation">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Case Number</h6>
                                            </th>
                                            <th style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">For</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Subject</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Date</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            @if ($user->privilege == 'investigation_admin_chief' || $user->privilege == 'investigation_clerk')
                                                <th>
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sortedInvestigations = $investigations->sortByDesc(function (
                                                $investigation,
                                            ) {
                                                return \Carbon\Carbon::parse($investigation->created_at);
                                            });
                                        @endphp

                                        @foreach ($sortedInvestigations as $investigation)
                                            <tr>
                                                <td>
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->case_number }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->for }}</h6>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">{{ $investigation->subject }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($investigation->date)->format('F j, Y') }}
                                                    </p>
                                                </td>
                                                @if ($investigation->Minimal != null)
                                                    <td>
                                                        <p class="mb-0 fw-normal">
                                                            @if ($investigation->Minimal->afor)
                                                                Operation <br>
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal">Minimal</p>
                                                    </td>
                                                @elseif($investigation->Spot != null)
                                                    <td>
                                                        <p class="mb-0 fw-normal">
                                                            @if ($investigation->Spot->afor)
                                                                Operation <br>
                                                            @endif
                                                            @if ($investigation->Spot->progress)
                                                                Progress <br>
                                                            @endif
                                                            @if ($investigation->Spot->final)
                                                                Final <br>
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal">Spot</p>
                                                    </td>
                                                @elseif($investigation->progress != null)
                                                    <td>
                                                        <p class="mb-0 fw-normal">
                                                            @if ($investigation->progress->Spot)
                                                                @if ($investigation->progress->Spot->afor)
                                                                    Operation <br>
                                                                @endif
                                                                Spot <br>
                                                                @if ($investigation->progress->Spot->final)
                                                                    Final <br>
                                                                @endif
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal">Progress</p>
                                                    </td>
                                                @elseif($investigation->final != null)
                                                    <td>
                                                        <p class="mb-0 fw-normal">
                                                            @if ($investigation->final->Spot)
                                                                @if ($investigation->final->Spot->afor)
                                                                    Operation <br>
                                                                @endif
                                                                Spot <br>
                                                                @if ($investigation->final->Spot->Progress)
                                                                    Progress <br>
                                                                @endif
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal">Final</p>
                                                    </td>
                                                @endif
                                                @if ($user->privilege == 'investigation_admin_chief' || $user->privilege == 'investigation_clerk')
                                                    @if ($investigation->minimal != null)
                                                        @php
                                                            $investigationDetail = $investigation->minimal;
                                                        @endphp
                                                        <td>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewMinimalModal{{ $investigationDetail->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-minimal
                                                                :investigation=$investigationDetail :responses=$responses
                                                                :personnels=$personnels></x-reports.Investigation.view-minimal>
                                                            <a href="{{ route('investigation.minimal.edit', ['minimal' => $investigationDetail->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i>
                                                                Update</a>

                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigationDetail->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                            <x-reports.investigation.investigation-delete :type="'minimal'"
                                                                :investigation="$investigationDetail"></x-reports.investigation.investigation-delete>
                                                        </td>
                                                    @elseif($investigation->spot != null)
                                                        @php
                                                            $investigationDetail = $investigation->spot;
                                                        @endphp
                                                        {{-- {{ dd($investigationDetail) }} --}}
                                                        <td class="border-bottom-0">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewSpotModal{{ $investigationDetail->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-spot
                                                                :investigation=$investigationDetail :responses=$responses
                                                                :personnels=$personnels></x-reports.Investigation.view-spot>

                                                            <a href="{{ route('investigation.spot.edit', ['spot' => $investigationDetail->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i>
                                                                Update</a>
                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigationDetail->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                            <x-reports.investigation.investigation-delete :type="'spot'"
                                                                :investigation="$investigationDetail"></x-reports.investigation.investigation-delete>
                                                        </td>
                                                    @elseif($investigation->progress != null)
                                                        @php
                                                            $investigationDetail = $investigation->progress;
                                                        @endphp
                                                        <td class="border-bottom-0">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewProgressModal{{ $investigationDetail->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-progress
                                                                :investigation=$investigationDetail :responses=$responses
                                                                :personnels=$personnels></x-reports.Investigation.view-progress>

                                                            <a href="{{ route('investigation.progress.edit', ['progress' => $investigationDetail->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i>
                                                                Update</a>
                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigationDetail->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                            <x-reports.investigation.investigation-delete :type="'progress'"
                                                                :investigation="$investigationDetail"></x-reports.investigation.investigation-delete>
                                                        </td>
                                                    @elseif($investigation->final != null)
                                                        @php
                                                            $investigationDetail = $investigation->final;
                                                        @endphp
                                                        <td class="border-bottom-0">
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#viewFinalModal{{ $investigationDetail->id }}"
                                                                class="btn btn-primary hide-menu w-100 mb-1"><i
                                                                    class="ti ti-eye"></i> View</button>
                                                            <x-reports.Investigation.view-final
                                                                :investigation=$investigationDetail :responses=$responses
                                                                :personnels=$personnels></x-reports.Investigation.view-final>
                                                            <x-reports.investigation.investigation-delete :type="'final'"
                                                                :investigation="$investigationDetail"></x-reports.investigation.investigation-delete>
                                                            <a href="{{ route('investigation.final.edit', ['final' => $investigationDetail->id]) }}"
                                                                class="btn btn-success w-100 mb-1"><i
                                                                    class="ti ti-pencil"></i> Update</a>
                                                            <br>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $investigationDetail->id }}"
                                                                class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                    class="ti ti-trash"></i> Delete</button>
                                                        </td>
                                                    @endif
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
            @include('partials.investigationScript')
        @endsection
