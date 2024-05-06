<div class="modal fade" tabindex="-1" id="viewModal{{ $investigation->id }}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder text-primary">{{ $investigation->investigation->subject }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                            <td colspan="2" class="fw-bold">Receiver</td>
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
                            <td> <b>{{ $investigation->respondingEngine->name }}</b> and Crew,
                                <b>{{ $investigation->respondingLeader->rank->slug . ' ' . $investigation->respondingLeader->last_name . ' ' . $investigation->respondingLeader->first_name }}</b>
                                Team Leader
                            </td>
                        </tr>
                        <tr>
                            <td>Time of Arrival on Scene:</td>
                            <td>{{ $investigation->time_arrival_on_scene }}</td>
                        </tr>
                        <tr>
                            <td>Alarm Status-Time:</td>
                            <td>{{ $investigation->alarm_status_time }}</td>
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
                    <div class="w-100 text-center fw-bolder">None photos found!</div>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
