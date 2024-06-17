@extends('layouts.user-template')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ranks</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Ranks</h5>
                                @if ($user->privilege == 'configuration_chief')
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#addRankModal">
                                        <i class="ti ti-plus"></i>
                                        Create
                                    </button>
                                    <x-truck.create :category="$active"></x-truck.create>
                                @endif
                            </div>
                            <div class="accordion accordion-flush table-responsive" id="accordionRankPersonnel">
                                <table class="table mb-0 align-middle w-100" id="operationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="fw-semibold mb-0">Slug
                                            </th>
                                            @if ($user->privilege == 'configuration_chief')
                                                <th class="fw-semibold mb-0 text-center">Action
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($ranks as $rank)
                                            <x-rank.edit :rank="$rank"> </x-rank.edit>
                                            <x-rank.delete :rank="$rank"> </x-rank.delete>
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $rank->name }}</td>
                                                <td>{{ $rank->slug }}</td>
                                                @if ($user->privilege == 'configuration_chief')
                                                    <td class="w-25 py-2">
                                                        <div class="d-flex flex-row">
                                                            <div class="me-1">
                                                                <button class="btn btn-success w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#editRankModal{{ $rank->id }}">
                                                                    <i class="ti ti-pencil"></i>
                                                                    Update

                                                                </button>
                                                            </div>
                                                            @if (count($rank->personnels ?? []) != 0)
                                                                <div class="me-1">
                                                                    <button disabled class="btn btn-secondary"
                                                                        data-bs-toggle="modal">
                                                                        <i class="ti ti-x"></i>
                                                                        Invalid
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="me-1">
                                                                    <button class="btn btn-danger w-100"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRankModal{{ $rank->id }}">
                                                                        <i class="ti ti-trash"></i>
                                                                        Delete

                                                                    </button>
                                                                </div>
                                                            @endif

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
        </div>
    </div>
    <x-rank.create :category="$active"> </x-rank.create>
@endsection
