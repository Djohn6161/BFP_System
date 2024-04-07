<style>
    .btn-reports {
        width: 200px;
    }
</style>

@extends('layouts.user-template')

@section('content')
    <div class="container-fluid">
        <!-- Row 1 -->
        <div class="col-lg-12">
            <!-- Monthly Earnings -->
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Add Personel</span>
                    </button>
                </div>
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="fw-semibold mb-4">BFP - Personnel</h5>
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                <div class="card justify-content-center" style="width: 18rem;">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#viewPersonnelModal">
                                        <div class="col py-2">
                                            <img src="{{ asset('assets/images/logos/tin.jpg') }}"
                                                class="card-img-top object-fit-cover rounded" height="300"
                                                alt="personnel picture">
                                            <div class="card-body">
                                                <h5 class="card-title text-center fw-bold fs-5">Don John Daryl Curativo</h5>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <!-- Add more card items as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <x-personnel.view :category="$active"> </x-personnel.view>
@endsection
