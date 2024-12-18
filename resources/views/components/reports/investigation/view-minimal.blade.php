<div class="modal fade" tabindex="-1" id="viewMinimalModal{{ $investigation->id }}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                {{-- {{dd($investigation)}} --}}
                <h3 class="modal-title fw-bolder text-primary">{{ $investigation->investigation->subject }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body px-4 pb-4 pt-0">
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Case Number:</div>
                    <div class="col-sm-10"><b>{{ $investigation->investigation->case_number }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">For:</div>
                    <div class="col-sm-10"><b>{{ $investigation->investigation->for }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Subject:</div>
                    <div class="col-sm-10"><b>{{ $investigation->investigation->subject }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Date:</div>
                    <div class="col-sm-10"><b>{{ $investigation->investigation->date }}</b></div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="2" class="fw-bolder">DETAILS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Date and Time of Actual Occurence:</td>
                            <td>{{ $investigation->dt_actual_occurence }}</td>
                        </tr>
                        <tr>
                            <td>Date and Time reported:</td>
                            <td>{{ $investigation->dt_reported }}</td>
                        </tr>
                        <tr>
                            <td>Incident Location:</td>
                            <td>{{ $investigation->incident_location }}</td>
                        </tr>
                        <tr>
                            <td>Involved Property/ Establishment:</td>
                            <td>{{ $investigation->involved_property }}</td>
                        </tr>
                        <tr>
                            <td>Property Data:</td>
                            <td>{{ $investigation->property_data }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="2" class="fw-bolder">RESPONSE AND SUPRESSION DATA</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- {{dd($investigation->receiver)}} --}}
                            <td colspan="1" class="fw-bold">Receiver</td>
                            <td colspan="1" class="fw-bold">{{($investigation?->receiverPersonnel?->rank?->slug ?? "Unknown") . " " . ($investigation?->receiverPersonnel?->last_name ?? "Unnknown") . " " . ($investigation?->receiverPersonnel?->first_name ?? "Unknown")}}</td>
                        </tr>
                        <tr>
                            <td>Caller Information:</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">Complete Name:</div>
                                    <div class="col-sm">{{ $investigation->caller_name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">Address:</div>
                                    <div class="col-sm">{{ $investigation->caller_address }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">Telephone Number:</div>
                                    <div class="col-sm">{{ $investigation->caller_number }}</div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>Notification Originator:</td>
                            <td>{{ $investigation->notification_originator }}</td>
                        </tr>
                        <tr>
                            <td>First Responding Unit:</td>
                            <td> <b>{{ $investigation->respondingEngine != null ? $investigation->respondingEngine->name : "Unknown" }}</b> and Crew,
                                <b>{{ ($investigation?->respondingLeader?->rank?->slug ?? "Unknown") . ' ' . ($investigation?->respondingLeader->last_name ?? "Unknown") . ' ' . ($investigation?->respondingLeader->first_name ?? "Unknown") }}</b>
                                Team Leader
                            </td>
                        </tr>
                        <tr>
                            <td>Time of Arrival on Scene:</td>
                            <td>{{ $investigation->time_arrival_on_scene }}</td>
                        </tr>
                        <tr>
                            <td>Alarm Status-Time:</td>
                            <td>{{ $investigation->alarm != null ? $investigation->alarm->name : "Unknown" }}</td>
                        </tr>
                        <tr>
                            <td>Time Fire Out:</td>
                            <td>{{ $investigation->Time_Fire_out }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="2" class="fw-bolder">INVOLVED PARTIES</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Owner of property/establishment:</td>
                            <td>{{ $investigation->property_owner }}</td>
                        </tr>
                        <tr>
                            <td>Occupant of property/establishment</td>
                            <td>{{ $investigation->property_occupant != '' ? $investigation->property_occupant : 'N/A' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="my-4 fw-bolder">DETAILS OF INVESTIGATION</h3>
                <div class="ps-5">
                    <p class="text-dark">
                        {!! $investigation->details !!}
                    </p>
                </div>
                <hr>
                <h3 class="my-4 fw-bolder">FINDINGS</h3>
                <div class="ps-5">
                    <p class="text-dark">
                        {!! $investigation->findings !!}
                    </p>
                </div>
                <hr>
                <h3 class="my-4 fw-bolder ">RECOMMENDATION</h3>
                <div class="ps-5">
                    <p class="text-dark">
                        {!! $investigation->recommendation !!}
                    </p>
                </div>
                <hr>
                <h3 class="my-4 fw-bolder ">PHOTOGRAPH OF FIRE SCENE</h3>
                @if ($investigation->photos == '' || $investigation->photos == null)
                    <div class="w-100 text-center fw-bolder">No photos found!</div>
                @else
                    @php
                        if ($investigation->photos != '') {
                            $photos = explode(', ', $investigation->photos);
                        }
                    @endphp
                    <div class="ps-5 row">
                        @foreach ($photos as $photo)
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body p-1">
                                        <a href="{{ asset('storage/minimal/' . $photo) }}" data-toggle="lightbox" data-gallery="example-gallery">
                                            <img style="height: 350px; object-fit: cover;" class="w-100" src="{{ asset('storage/minimal/' . $photo) }}" alt="Sample Image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewOperationModal{{$investigation->investigation_id}}"><i class="ti ti-eye"></i> View Operation</button>
                <a href="{{route('investigation.minimal.print', ['minimal' => $investigation->id])}}" type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>

                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<x-reports.investigation.view-operation :act="'minimal'" :operation="$investigation->afor" :investigation="$investigation" :responses="$responses" :personnels="$personnels"></x-reports.investigation.view-operation>
