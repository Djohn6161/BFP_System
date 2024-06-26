@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Reports</a></li>
                <li class="breadcrumb-item"><a href="{{ route('investigation.index') }}"> All Investigation Reports</a></li>
                <li class="breadcrumb-item"> <a href="{{ route('investigation.progress.index') }}">Progress Investigation
                        Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Progress Investigation Reports</li>
            </ol>
        </nav>
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
                    <b>{{ $progress->investigation->subject }}</b>
                </h3>
                <div class="row">
                    <form method="POST"
                        action="{{ route('investigation.progress.update', ['progress' => $progress->id]) }}">
                        @csrf
                        @method('PUT')
                        <x-reports.investigation.memo-investigate :spot=$progress
                            :station=$station></x-reports.investigation.memo-investigate>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">AUTHORITY:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-3 mb-3">
                                <label for="authority" class="form-label">
                                    <h3></h3>
                                </label>
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
                                    <div id="authority" style="border: 1px solid lightgray; height: 200px;">
                                        {!! old('authority') ?? $progress->authority !!}

                                    </div>
                                </div>
                                <input type="hidden" name="authority" id="autho">
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">MATTERS INVESTIGATED:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-3 mb-3">
                                <label for="matters-investigated" class="form-label">
                                    <h3></h3>
                                </label>
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
                                    <div id="matters-investigated" style="border: 1px solid lightgray; height: 200px;">
                                        {!! old('matters_investigated') ?? $progress->matters_investigated !!}
                                    </div>
                                </div>
                                <input type="hidden" name="matters_investigated" id="matters">
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">FACTS OF THE CASE:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-3 mb-3">
                                <label for="facts-of-the-case" class="form-label">
                                    <h3></h3>
                                </label>
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
                                    <div id="facts-of-the-case" style="border: 1px solid lightgray; height: 200px;">
                                        {!! old('facts_of_the_case') ?? $progress->facts_of_the_case !!}

                                    </div>
                                </div>
                                <input type="hidden" name="facts_of_the_case" id="facts">
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DISPOSITION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-3 mb-3">
                                <label for="disposition" class="form-label"></label>
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
                                    <div id="disposition" style="border: 1px solid lightgray; height: 200px;">
                                        {!! old('disposition') ?? $progress->disposition !!}
                                    </div>
                                </div>
                                <input type="hidden" name="disposition" id="dispo">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col d-flex justify-content-end px-0">
                                @if ($user->privilege == 'investigation_admin_chief')
                                    <button type="submit" id="submit" class="btn btn-success">
                                        <span>
                                            <i class="ti ti-send"></i>
                                        </span>
                                        <span>Submit</span>
                                    </button>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#passUpdateModal" type="button"
                                        id="submit" class="btn btn-success">
                                        <span>
                                            <i class="ti ti-send"></i>
                                        </span>
                                        <span>Submit</span>
                                    </button>
                                    <x-reports.investigation.passcode></x-reports.investigation.passcode>
                                @endif

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <script>
            // First Quill editor initialization
            const quill1 = new Quill('#authority', {
                modules: {
                    toolbar: '#toolbar1',
                },
                theme: 'snow',
                placeholder: 'a. Section 50, RULE VII, Implementing Rules...',
            });
        </script>
        <script>
            // Second Quill editor initialization
            const quill2 = new Quill('#matters-investigated', {
                modules: {
                    toolbar: '#toolbar2',
                },
                theme: 'snow',
                placeholder: 'a. The origin and cause...',
            });
        </script>
        <script>
            // Third Quill editor initialization
            const quill3 = new Quill('#facts-of-the-case', {
                modules: {
                    toolbar: '#toolbar3',
                },
                theme: 'snow',
                placeholder: 'This pertains is on-going...',
            });
        </script>
        <script>
            // Forth Quill editor initialization
            const quill4 = new Quill('#disposition', {
                modules: {
                    toolbar: '#toolbar4',
                },
                theme: 'snow',
                placeholder: 'The Final Investigation is...',
            });
            $("#submit").click(function() {
                $("#autho").val(quill1.root.innerHTML);
                $("#matters").val(quill2.root.innerHTML);
                $("#facts").val(quill3.root.innerHTML);
                $("#dispo").val(quill4.root.innerHTML);
            });
        </script>
    @endsection
