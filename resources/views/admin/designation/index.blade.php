@extends('layouts.user-template')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Designations</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">

                </div>
                <div class="col-lg-12">
                    <div class=" col-lg-12 card">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title fw-semibold mb-4">Occupancy Names
                                    <span class=" ms-3 badge rounded-pill bg-secondary"></span>
                                </h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addOtherDesignationModal">
                                    <i class="ti ti-plus"></i>

                                    Add Designation
                                </button>
                            </div>

                            <div>
                                <table class="table mb-0 align-middle w-100" id="designationTable">
                                    <thead class="text-dark fs-4">

                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($otherDes as $item)
                                            <tr>
                                                <td class="py-2">{{ $item->id }}</td>
                                                <td class="py-2">{{ $item->name }}</td>
                                                <td class="w-25 py-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="me-1">
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editOtherDesignationModal{{ $item->id }}">
                                                                <i class="ti ti-pencil"></i>
                                                                Update</button>
                                                        </div>
                                                        <div class="me-1">

                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#deleteOtherDesignationModal{{ $item->id }}"
                                                                class="btn btn-danger hide-menu">
                                                                <i class="ti ti-trash"></i>
                                                                Delete</button>
                                                        </div>
                                                    </div>
                                                    <x-designation.other.edit-other
                                                        :designation="$item"></x-designation.other.edit-other>
                                                    <x-designation.other.delete-other
                                                        :designation="$item"></x-designation.other.delete-other>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-center border-bottom border-4 border-warning pb-2">Sections</h3>

                    <div class="row">
                        @foreach ($sections as $section)
                            <x-designation.section.edit :section=$section></x-designation.section.edit>
                            <x-designation.section.delete :section=$section></x-designation.section.delete>
                            <x-designation.section.add-unit :section=$section></x-designation.section.add-unit>

                            <div class="col p-2">
                                <div class="col-lg-12 card">

                                    <div class="card-body p-4">

                                        <!-- Display Total Personnel -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="fw-semibold text-center">{{ $section->name }}
                                                <span class=" ms-3 badge rounded-pill bg-secondary"></span>
                                            </h5>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Manage
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#addUnitModal{{ $section->id }}">Add
                                                            Designation</button></li>
                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editSectionModal{{ $section->id }}">
                                                            Edit
                                                            Section</button></li>
                                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#deleteSectionModal{{ $section->id }}">Delete
                                                            Section</button></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div>
                                            @unless (count($designations->where('section', $section->id)) == 0)
                                                <table class="table mb-0 align-middle w-100" id="designationTable">
                                                    <thead class="text-dark fs-4">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($designations->where('section', $section->id) as $item)
                                                            <tr>
                                                                <td class="py-2">{{ $item->id }}</td>
                                                                <td class="py-2">{{ $item->name }}</td>
                                                                <td class="py-2">
                                                                    <div class="d-flex flex-row">
                                                                        <div class="me-1">
                                                                            <button type="button" class="btn btn-success w-100"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#editUnitModal{{ $item->id }}">
                                                                                <i class="ti ti-pencil"></i>
                                                                                Update</button>
                                                                        </div>
                                                                        <div >
                                                                            <button type="button" data-bs-toggle="modal"
                                                                                data-bs-target="#deleteUnitModal{{ $item->id }}"
                                                                                class="btn btn-danger hide-menu w-100">
                                                                                <i class="ti ti-trash"></i>
                                                                                Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <x-designation.unit.edit-unit
                                                                        :designation="$item"></x-designation.unit.edit-unit>
                                                                    <x-designation.unit.delete-unit
                                                                        :designation="$item"></x-designation.unit.delete-unit>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="alert alert-secondary text-center rounded">

                                                    <p class="mb-1 fw-bold text-dark rounded">No Designation Found</p>
                                                    <button type="button" class="text-uppercase btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#addUnitModal{{ $section->id }}"><span> <i
                                                                class="ti ti-plus"></i></span> Add
                                                        Designation</button>
                                                </div>
                                            @endunless
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="d-grid">
                        <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addDesignationSectionModal">+ Add Section</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <x-designation.add-section></x-designation.add-section>
    <x-designation.other.add-other></x-designation.other.add-other>
@endsection
