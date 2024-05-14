<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->

        <div class="col-lg-12">
            <!-- Monthly Earnings -->

            <div class="row">
                <div class="col d-flex justify-content-end mb-2">

                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 text-capitalize">
                                Trash {{ $active != 'operation' ? $active : 'All' }}</h5>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="trashOperationTable">
                                    <thead class="text-dark fs-4">
                                        <tr class="text-center">
                                            <th class="border-bottom-0 " style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Deleted at</h6>
                                            </th>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Alarm Received</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Transmitted By</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($operations as $operation)
                                            <x-trash.operation.restore :operation=$operation></x-trash.operation.restore>
                                            <tr class="justify-content-center text-center">

                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ \Carbon\Carbon::parse($operation->deleted_at)->format('F j, Y') }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $operation->alarm_received }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $operation->transmitted_by }}</p>
                                                </td>

                                                <td class="border-bottom-0">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#restoreTrashOperationModal{{ $operation->id }}"
                                                        class="btn btn-success w-100 mb-1">Restore</button>
                                                    <br>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteTrashOperationModal{{ $operation->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1">Delete</button>
                                                    <x-trash.operation.delete :operation="$operation"></x-trash.operation.delete>
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
