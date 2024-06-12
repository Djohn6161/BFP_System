@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Stations</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <form method="POST" action="{{ route('admin.stations.update', $station->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Stations</h3>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-9 mb-3">
                                        <label for="inputName" class="form-label">Station Name</label>
                                        <input type="text" class="form-control" name="name" {{$user->privilege != 'configuration_chief' ? ' disabled' : ""}}
                                            value="{{ $station->name }}">
                                    </div>
                                    <div class="col-lg-3 mb-6">
                                        <label for="acronym" class="form-label">Acronym</label>
                                        <input type="text" class="form-control" name="acronym" {{$user->privilege != 'configuration_chief' ? ' disabled' : ""}}
                                            value="{{ $station->acronym }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-6">
                                        <label for="caseNumberTemp" class="form-label">Case Number Template</label>
                                        <input type="text" class="form-control" name="caseNumberTemp" {{$user->privilege != 'configuration_chief' ? ' disabled' : ""}}
                                            value="{{ $station->caseNumberTemp }}">
                                    </div>
                                    <div class="col-lg-6 mb-6">
                                        <label for="blotterNumberTemp" class="form-label">Blotter Number Template</label>
                                        <input type="text" class="form-control" name="blotterNumberTemp" {{$user->privilege != 'configuration_chief' ? ' disabled' : ""}}
                                            value="{{ $station->blotterNumberTemp }}">
                                    </div>
                                </div>
                                @if ($user->privilege == 'configuration_chief')
                                    <div class="col d-flex justify-content-end mb-2 py-3">
                                        <button id="saveChangesBtn" class="btn btn-primary">Update Station</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
