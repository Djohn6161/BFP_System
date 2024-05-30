
@extends('layouts.user-template')
@section('content')


    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Operation Trash</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="trashOperationTable">
                                    <thead class="text-dark fs-4">
                                        <tr class="text-center">
                                            <th>
                                                Deleted at
                                            </th>
                                            <th>
                                                Alarm Received
                                            </th>
                                            <th>
                                                Transmitted By
                                            </th>
                                            <th class="w-25">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($operations as $operation)
                                            <x-trash.operation.restore :operation=$operation></x-trash.operation.restore>
                                            <tr>
                                                <td>
                                                        {{ \Carbon\Carbon::parse($operation->deleted_at)->format('F j, Y') }}
                                                </td>
                                                <td>
                                                    {{ $operation->alarm_received }}
                                                </td>
                                                <td>
                                                    {{ $operation->transmitted_by }}
                                                </td>

                                                <td class="w-25">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#restoreTrashOperationModal{{ $operation->id }}"
                                                        class="btn btn-success w-100 mb-1">Restore</button>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteTrashOperationModal{{ $operation->id }}"
                                                        class="btn btn-danger hide-menu w-100">Delete</button>
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
