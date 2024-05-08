@extends('layouts.user-template')

@section('content')
    <div class="container-fluid">
        <!-- Row 1 -->
        <div class="col-lg-12">
            <!-- Monthly Earnings -->
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDesignationModal">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Add Designation</span>
                    </button> --}}

                </div>
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body p-4">

                            <!-- Display Total Personnel -->
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-semibold text-center">Other Designations
                                    <span class=" ms-3 badge rounded-pill bg-secondary"></span>
                                </h5>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addOtherDesignationModal">Add Designation</button>
                            </div>

                            <div>
                                <table class="table mb-0 align-middle w-100" id="designationTable">
                                    <thead class="text-dark fs-4">

                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($designations as $designation) --}}
                                        {{-- <x-designation.edit :designation="$designation"> </x-designation.edit>
                                        <x-designation.delete :designation="$designation"> </x-designation.delete> --}}
                                        @foreach ($otherDes as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td class="w-25">
                                                    <button type="button" class="btn btn-success w-100 mb-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editOtherDesignationModal{{ $item->id }}">Update</button>
                                                    <br>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteOtherDesignationModal{{ $item->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1">Delete</button>
                                                    <x-designation.other.edit-other :designation=$item></x-designation.other.edit-other>
                                                    <x-designation.other.delete-other :designation=$item></x-designation.other.delete-other>
                                                </td>
                                                {{-- <td>{{ $designation->class }}</td> --}}
                                                {{-- <td>{{ substr(App\Models\Designation::find($designation->section)->name, 0, 3) ?? 'Unspecified' }}</td> --}}
                                            </tr>
                                        @endforeach

                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @foreach ($sections as $section)
                        <div class="card w-100">

                            <div class="card-body p-4">

                                <!-- Display Total Personnel -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-semibold text-center">{{ $section->name }}
                                        <span class=" ms-3 badge rounded-pill bg-secondary"></span>
                                    </h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Manage
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#addUnitModal">Add Unit</button></li>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editSectionModal">Edit Section</button></li>
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#deleteSectionModal">Delete Section</button></li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <table class="table mb-0 align-middle w-100" id="designationTable">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($designations as $designation) --}}
                                            {{-- <x-designation.edit :designation="$designation"> </x-designation.edit>
                                        <x-designation.delete :designation="$designation"> </x-designation.delete> --}}
                                            @foreach ($designations->where('section', $section->id) as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="w-25">
                                                        <button type="button"
                                                            class="btn btn-success w-100 mb-1"data-bs-toggle="modal"
                                                            data-bs-target="#editUnitModal">Update</button>
                                                        <br>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#deleteUnitModal"
                                                            class="btn btn-danger hide-menu w-100 mb-1">Delete</button>
                                                    </td>
                                                    {{-- <td>{{ $designation->class }}</td> --}}
                                                    {{-- <td>{{ substr(App\Models\Designation::find($designation->section)->name, 0, 3) ?? 'Unspecified' }}</td> --}}
                                                </tr>
                                            @endforeach

                                            {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-grid">
                        <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addDesignationSectionModal">+ Add Section</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- <x-designation.create :category="$active"> </x-designation.create> --}}
    <x-designation.add-section></x-designation.add-section>
    <x-designation.other.add-other></x-designation.other.add-other>

    <x-designation.section.add-unit></x-designation.section.add-unit>
    <x-designation.section.edit></x-designation.section.edit>
    <x-designation.section.delete></x-designation.section.delete>
    <x-designation.unit.edit-unit></x-designation.unit.edit-unit>
    <x-designation.unit.delete-unit></x-designation.unit.delete-unit>
@endsection
