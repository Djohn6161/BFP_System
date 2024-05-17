<style>
    .btn-reports {
        width 200px
    }

    .second-div {
        border: 1px solid #e5e5e5;
        padding: 15px;
        margin-bottom: 20px;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    h3.a {
        text-align: center;
    }

    /* .preview-image {
        max-width: 200px;
        height: auto;
        margin: 10px;
    } */
    .hidden-label {
        color: transparent;
        /* Make label content transparent */
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="col d-flex justify-content-start mb-2">
            <a href="{{ route('investigation.final.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <div class="row mb-4">
                    <div class="col d-flex justify-content-start px-0">
                        <a href="{{ route('investigation.progress.index') }}" class="btn btn-primary">
                            <span>
                                <i class="ti ti-arrow-back"></i>
                            </span>
                            <span>Go Back</span>
                        </a>
                    </div>
                </div>
                <h3 class="border-bottom border-4 border-primary pb-2 mb-3 text-capitalize">
                    <b>{{ $final->investigation->subject }}</b>
                </h3>
                <div class="row">
                    <form action="{{ route('investigation.final.update', ['final' => $final]) }}" class="needs-validation"
                        novalidate method="POST" id="finalCreate">
                        @csrf
                        @method('PUT')
                        <x-reports.investigation.memo-investigate :spot=$final></x-reports.investigation.memo-investigate>


                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">

                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">FINAL INVESTIGATION REPORT (F.I.R)
                            </h3>

                            <div class="col-lg-12 mb-3">
                                <label for="intelligence_unit" class="form-label">INVESTIGATION AND INTELLIGENCE
                                    UNIT</label>
                                <input type="text" placeholder="Eg. Purok 5 Paubla, Ligao City" id="intelligence_unit"
                                    name="intelligence_unit"
                                    class="form-control {{ $errors->has('intelligence_unit') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('intelligence_unit') ?? ($final->intelligence_unit ?? 'Ligao City Fire Station, Ligao City Albay') }}"
                                    required>
                                @error('intelligence_unit')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <h5 class="mt-3"><i>PLACE OF FIRE</i></h5>
                            <div class="col-lg-6 mb-4">
                                <label for="barangay-select" class="form-label">Barangay</label>
                                <select class="form-select" id="barangay-select" name="barangay" required>
                                    <option value="">-- Select a Barangay --</option>
                                    @foreach ($barangay as $barangay)
                                        <option
                                            {{ old('barangay') ?? ($spot->barangay ?? '') == $barangay->name ? 'selected' : '' }}
                                            value="{{ $barangay->name }}">
                                            {{ $barangay->name }} </option>
                                    @endforeach

                                </select>
                                @error('barangay')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Zone/Street" -->
                            <div class="col-lg-6 mb-4">
                                <label for="zone_street" class="form-label">Zone/Street</label>
                                <input type="text" placeholder="Eg. Zone 4" id="zone_street" name="zone_street"
                                    class="form-control {{ $errors->has('zone_street') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('zone_street') ?? $final->street }}" required>
                                @error('zone_street')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Other Location/Landmark" -->
                            <div class="col-lg-12 mb-5">
                                <label for="landmark" class="form-label">Other Location/Landmark</label>
                                <input type="text" placeholder="Eg. LCC Mall" id="landmark" name="landmark"
                                    class="form-control {{ $errors->has('landmark') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('landmark') ?? $location }}" required>
                                @error('landmark')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-lg-6 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <input type="text" placeholder="Eg. Purok 5 Paubla, Ligao City" class="form-control" id="dateTime" required>
                            </div> --}}

                            <div class="col-lg-6 mb-3">
                                <label for="time_alarm" class="form-label">TIME OF ALARM</label>
                                <input type="text" placeholder="Eg. 0034H" id="time_alarm" name="time_alarm"
                                    class="form-control {{ $errors->has('time_alarm') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('time_alarm') ?? $td[0] }}" required>
                                @error('time_alarm')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="date_alarm" class="form-label">DATE OF ALARM</label>
                                <input type="date" placeholder="Eg. 30 March 2024" id="date_alarm" name="date_alarm"
                                    class="form-control {{ $errors->has('date_alarm') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('date_alarm') ?? $td[1] }}" required>
                                @error('date_alarm')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="establishment_burned" class="form-label">ESTABLISHMENT BURNED</label>
                                <input type="text" placeholder=" Eg. Romy Nabas Residence" id="establishment_burned"
                                    name="establishment_burned"
                                    class="form-control {{ $errors->has('establishment_burned') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('establishment_burned') ?? $final->establishment_burned }}" required>
                                @error('establishment_burned')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="damage_to_property" class="form-label">DAMAGE TO PROPERTY</label>
                                <input type="number" placeholder=" Eg. Php 20,000.00" id="damage_to_property"
                                    name="damage_to_property"
                                    class="form-control {{ $errors->has('damage_to_property') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('damage_to_property') ?? $final->damage_to_property }}" required>
                                @error('damage_to_property')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- {{dd(old('victim'))}} --}}
                            @if (old('victim') ?? false)
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-6 m-0 p-0">
                                            <label for="fireVictims" class="form-label me-2">FIRE VICTIM/S</label>
                                            <button type="button" class="btn btn-sm btn-primary mb-1"
                                                id="addFireVictims">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="fireVictimsContainer">
                                    @foreach (old('victim') as $victim)
                                        <div class="col-lg-6 mb-3">
                                            <div class="input-group"><input type="text"
                                                    placeholder="Enter victim name"
                                                    class="form-control {{ $errors->has('victim') != '' ? 'is-invalid' : '' }}"
                                                    name="victim[]" required value="{{ $victim }}"><button
                                                    type="button" class="btn btn-outline-danger removeInput">x</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('victim')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                                {{-- {{dd($victim)}} --}}
                            @elseif($victims ?? false)
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-6 m-0 p-0">
                                            <label for="fireVictims" class="form-label me-2">FIRE VICTIM/S</label>
                                            <button type="button" class="btn btn-sm btn-primary mb-1"
                                                id="addFireVictims">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="fireVictimsContainer">
                                    @foreach ($victims as $victim)
                                        <div class="col-lg-6 mb-3">
                                            <div class="input-group"><input type="text"
                                                    placeholder="Enter victim name"
                                                    class="form-control {{ $errors->has('victim') != '' ? 'is-invalid' : '' }}"
                                                    name="victim[]" required value="{{ $victim->name }}"><button
                                                    type="button" class="btn btn-outline-danger removeInput">x</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('victim')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            @else
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-6 m-0 p-0">
                                            <label for="fireVictims" class="form-label me-2">FIRE VICTIM/S</label>
                                            <button type="button" class="btn btn-sm btn-primary mb-1"
                                                id="addFireVictims">+
                                                ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="fireVictimsContainer">
                                    <div class="col-lg-6 mb-3">
                                        <div class="input-group"><input type="text" placeholder="Enter victim name"
                                                class="form-control {{ $errors->has('victim') != '' ? 'is-invalid' : '' }}"
                                                name="victim[]" required value=""><button type="button"
                                                class="btn btn-outline-danger removeInput">x</button></div>
                                    </div>
                                    <!-- Input fields will be appended here -->
                                </div>

                                @error('victim')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>
                        <div class="mb-5"></div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">ORIGIN OF FIRE:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-1 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar6">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="orig">
                                        {!! old('origin_of_fire') ?? $final->origin_of_fire !!}
                                    </div>

                                </div>
                                <input type="hidden" id="origin_of_fire" name="origin_of_fire">
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">CAUSE OF FIRE:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-1 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar7">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="cause">
                                        {!! old('cause_of_fire') ?? $final->cause_of_fire !!}
                                    </div>

                                </div>
                                <input type="hidden" id="cause_of_fire" name="cause_of_fire">
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">SUBSTANTIATING DOCUMENTS:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-1 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar1">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="subsDoc">
                                        {!! old('substantiating_documents') ?? $final->substantiating_documents !!}
                                    </div>

                                </div>
                                <input type="hidden" id="substantiating_documents" name="substantiating_documents">
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">FACTS OF THE CASE:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar2">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="facts">
                                        {!! old('facts_of_the_case') ?? $final->facts_of_the_case !!}
                                    </div>

                                </div>
                                <input type="hidden" id="facts_of_the_case" name="facts_of_the_case">

                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DISCUSSION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar3">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="discus">
                                        {!! old('discussion') ?? $final->discussion !!}
                                    </div>

                                </div>
                                <input type="hidden" id="discussion" name="discussion">
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">FINDINGS:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar4">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="find">
                                        {!! old('findings') ?? $final->findings !!}
                                    </div>

                                </div>
                                <input type="hidden" id="findings" name="findings">
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">RECOMMENDATION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar5">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="recom">
                                        {!! old('recommendation') ?? $final->recommendation !!}
                                    </div>

                                </div>
                                <input type="hidden" id="recommendation" name="recommendation">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end px-0">
                                <button type="submit" id="submit" class="btn btn-success">
                                    <span>
                                        <i class="ti ti-send"></i>
                                    </span>
                                    <span>Submit</span>
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#addFireVictims").click(function() {
                var inputField =
                    '<div class="col-lg-6 mb-3"><div class="input-group"><input type="text" placeholder="Enter victim name" class="form-control {{ $errors->has('victim') != '' ? 'is-invalid' : '' }}" name="victim[]" required value=""><button type="button" class="btn btn-outline-danger removeInput">x</button></div></div>';
                $("#fireVictimsContainer").append(inputField);
            });

            // Remove dynamically added input field
            $(document).on('click', '.removeInput', function() {
                $(this).closest('.col-lg-6').remove();
            });
        });
        // Get the input element
        var input = document.getElementById('telephone');

        // Listen for input events
        input.addEventListener('input', function() {
            // Remove any non-numeric characters
            this.value = this.value.replace(/\D/g, '');

            // Limit the input to exactly 11 digits
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11);
            }
        });
    </script>

    <script>
        const quill1 = new Quill('#subsDoc', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar1',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
    <script>
        const quill2 = new Quill('#facts', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar2',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
    <script>
        const quill3 = new Quill('#discus', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar3',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
    <script>
        const quill4 = new Quill('#find', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar4',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
    <script>
        const quill6 = new Quill('#orig', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar6',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
    <script>
        const quill7 = new Quill('#cause', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar7',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
    <script>
        const quill5 = new Quill('#recom', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar5',
            },

            placeholder: 'Compose an epic...',
        });
        $("#submit").click(function() {
            $("#substantiating_documents").val(quill1.root.innerHTML);
            $("#facts_of_the_case").val(quill2.root.innerHTML);
            $("#discussion").val(quill3.root.innerHTML);
            $("#findings").val(quill4.root.innerHTML);
            $("#recommendation").val(quill5.root.innerHTML);
            $("#origin_of_fire").val(quill6.root.innerHTML);
            $("#cause_of_fire").val(quill7.root.innerHTML);
        });
    </script>
@endsection
