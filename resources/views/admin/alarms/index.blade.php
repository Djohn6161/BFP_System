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
                    <a href="{{ route('operation.create.form') }}" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addAlarmModal">Create</a>
              
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Alarms</h5>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="operationTable">
                                    <thead class="text-dark fs-4 ">
                                        <tr>
                                            <th class="border-bottom-0 text-center"> Alarm Name</th>
                                            <th class="border-bottom-0 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alarm_list as $list)
                                            <x-alarm.edit :list="$list"></x-alarm.edit> 
                                            <tr class="text-center">
                                                <td class="border-bottom-0">{{ $list->name }}</td>

                                                <td class="border-bottom-0">
                                                
                                                    <button href="editAlarmModal" class="btn btn-success w-100 mb-1" data-bs-toggle="modal"
                                                    data-bs-target="#editAlarmModal{{ $list->id }}">Update
                                                    

                                                    <i class="ti ti-pencil"></i>
                                                </button>
                                                    <br>
                                                    <button type="button" class="btn btn-danger w-100 mb-1" data-bs-toggle="modal"
                                                    data-bs-target="#deleteAlarmModalll{{ $list->id }}">Delete
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                                    <x-alarm.delete :list="$list"></x-alarm.delete>

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
            <x-alarm.create :category="$active"></x-alarm.create>
        @endsection
