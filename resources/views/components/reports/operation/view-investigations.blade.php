@if ($operation->minimal)
    <div class="modal fade" tabindex="-1" id="viewMinimalOperationModal{{ $operation->id }}">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header pt-4 px-4 pb-1">
                    {{-- {{dd($operation->minimal)}} --}}
                    <h3 class="modal-title fw-bolder text-primary">{{ $operation->minimal->investigation->subject }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body px-4 pb-4 pt-0">
                    <div class="row p-2">
                        <div class="col-sm-2 text-dark">Case Number:</div>
                        <div class="col-sm-10"><b>{{ $operation->minimal->investigation->case_number }}</b></div>
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-2 text-dark">For:</div>
                        <div class="col-sm-10"><b>{{ $operation->minimal->investigation->for }}</b></div>
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-2 text-dark">Subject:</div>
                        <div class="col-sm-10"><b>{{ $operation->minimal->investigation->subject }}</b></div>
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-2 text-dark">Date:</div>
                        <div class="col-sm-10"><b>{{ $operation->minimal->investigation->date }}</b></div>
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
                                <td>{{ $operation->minimal->dt_actual_occurence }}</td>
                            </tr>
                            <tr>
                                <td>Date and Time reported:</td>
                                <td>{{ $operation->minimal->dt_reported }}</td>
                            </tr>
                            <tr>
                                <td>Incident Location:</td>
                                <td>{{ $operation->minimal->incident_location }}</td>
                            </tr>
                            <tr>
                                <td>Involved Property/ Establishment:</td>
                                <td>{{ $operation->minimal->involved_property }}</td>
                            </tr>
                            <tr>
                                <td>Property Data:</td>
                                <td>{{ $operation->minimal->property_data }}</td>
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
                                {{-- {{dd($operation->minimal->receiver)}} --}}
                                <td colspan="1" class="fw-bold">Receiver</td>
                                <td colspan="1" class="fw-bold">
                                    {{ $operation->minimal->receiverPersonnel->rank->slug . ' ' . $operation->minimal->receiverPersonnel->last_name . ' ' . $operation->minimal->receiverPersonnel->first_name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Caller Information:</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-4">Complete Name:</div>
                                        <div class="col-sm">{{ $operation->minimal->caller_name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">Address:</div>
                                        <div class="col-sm">{{ $operation->minimal->caller_address }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">Telephone Number:</div>
                                        <div class="col-sm">{{ $operation->minimal->caller_number }}</div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td>Notification Originator:</td>
                                <td>{{ $operation->minimal->notification_originator }}</td>
                            </tr>
                            <tr>
                                <td>First Responding Unit:</td>
                                <td> <b>{{ $operation->minimal->respondingEngine->name }}</b> and Crew,
                                    <b>{{ $operation->minimal->respondingLeader->rank->slug . ' ' . $operation->minimal->respondingLeader->last_name . ' ' . $operation->minimal->respondingLeader->first_name }}</b>
                                    Team Leader
                                </td>
                            </tr>
                            <tr>
                                <td>Time of Arrival on Scene:</td>
                                <td>{{ $operation->minimal->time_arrival_on_scene }}</td>
                            </tr>
                            <tr>
                                <td>Alarm Status-Time:</td>
                                <td>{{ $operation->minimal->alarm->name }}</td>
                            </tr>
                            <tr>
                                <td>Time Fire Out:</td>
                                <td>{{ $operation->minimal->Time_Fire_out }}</td>
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
                                <td>{{ $operation->minimal->property_owner }}</td>
                            </tr>
                            <tr>
                                <td>Occupant of property/establishment</td>
                                <td>{{ $operation->minimal->property_occupant != '' ? $operation->minimal->property_occupant : 'N/A' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="my-4 fw-bolder">DETAILS OF INVESTIGATION</h3>
                    <div class="ps-5">
                        <p class="text-dark">
                            {!! $operation->minimal->details !!}
                        </p>
                    </div>
                    <hr>
                    <h3 class="my-4 fw-bolder">FINDINGS</h3>
                    <div class="ps-5">
                        <p class="text-dark">
                            {!! $operation->minimal->findings !!}
                        </p>
                    </div>
                    <hr>
                    <h3 class="my-4 fw-bolder ">RECOMMENDATION</h3>
                    <div class="ps-5">
                        <p class="text-dark">
                            {!! $operation->minimal->recommendation !!}
                        </p>
                    </div>
                    <hr>
                    <h3 class="my-4 fw-bolder ">PHOTOGRAPH OF FIRE SCENE</h3>
                    @if ($operation->minimal->photos == '' || $operation->minimal->photos == null)
                        <div class="w-100 text-center fw-bolder">No photos found!</div>
                    @else
                        @php
                            if ($operation->minimal->photos != '') {
                                $photos = explode(', ', $operation->minimal->photos);
                            }
                        @endphp
                        <div class="ps-5 row">
                            @foreach ($photos as $photo)
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <a href="{{ asset('storage/minimal/' . $photo) }}" data-toggle="lightbox"
                                                data-gallery="example-gallery">
                                                <img style="height: 350px; object-fit: cover;" class="w-100"
                                                    src="{{ asset('storage/minimal/' . $photo) }}" alt="Sample Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#viewOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i> View
                        Operation</button>

                    @if ($operation->spot)
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                            data-bs-target="#viewSpotOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i> View
                            Spot</button>
                        @if ($operation->spot->progress)
                            `
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#viewProgressOperationModal{{ $operation->id }}"><i
                                    class="ti ti-eye"></i>
                                View Progress</button>
                        @endif

                        @if ($operation->spot->final)
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                data-bs-target="#viewFinalOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i>
                                View Final</button>
                        @endif
                    @endif
                    <a href="{{ route('investigation.minimal.print', ['minimal' => $operation->minimal->id]) }}"
                        type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>

                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

@endif

@if ($operation->spot)
    <div class="modal fade" tabindex="-1" id="viewSpotOperationModal{{ $operation->id }}">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header pt-4 px-4 pb-1">
                    <h3 class="modal-title fw-bolder text-primary">{{ $operation->spot->investigation->subject }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body pt-4 px-4 pt-0">
                    <div class="row p-2">
                        <div class="col-sm-2 text-dark">For:</div>
                        <div class="col-sm-10"><b>{{ $operation->spot->investigation->for }}</b></div>
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-2 text-dark">Subject:</div>
                        <div class="col-sm-10"><b>{{ $operation->spot->investigation->subject }}</b></div>
                    </div>
                    <div class="row p-2">
                        <div class="col-sm-2 text-dark">Date:</div>
                        <div class="col-sm-10"><b>{{ $operation->spot->investigation->date }}</b></div>
                    </div>
                    <hr>

                    <table class="table">
                        <tr>
                            @php
                                if ($operation->spot->landmark == null || $operation->spot->landmark == '') {
                                    $location = $operation->spot->address_occurence;
                                } else {
                                    $location = $operation->spot->landmark;
                                }
                            @endphp
                            <th colspan="2">DTPO</th>
                            <td colspan="4">
                                {{ $operation->spot->date_occurence . ', ' . $operation->spot->time_occurence . ', ' . $location }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">INVOLVED</th>
                            <td colspan="2">{{ $operation->spot->involved }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">NAME OF ESTABLISHMENT</th>
                            <td colspan="2">{{ $operation->spot->name_of_establishment }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">OWNER</th>
                            <td colspan="2">{{ $operation->spot->owner }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">OCCUPANT</th>
                            <td colspan="2">{{ $operation->spot->occupant }}</td>
                        </tr>
                        <tr>
                            <th rowspan="2">CASUALTY</th>
                            <th>Fatality</th>
                            <td>{{ $operation->spot->fatality != 0 ? $operation->spot->fatality : 'Negative' }}</td>
                        </tr>
                        <tr>
                            <th>Injured</th>
                            <td>{{ $operation->spot->injured != 0 ? $operation->spot->injured : 'Negative' }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">ESTIMATED DAMAGE</th>
                            <td colspan="2">
                                {{ '₱ ' . number_format($operation->spot->estimate_damage, 0, '.', ',') }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">TIME FIRE STARTED</th>
                            <td colspan="2">{{ $operation->spot->time_fire_start }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">TIME OF FIRE OUT</th>
                            <td colspan="2">{{ $operation->spot->time_fire_out }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">ALARM</th>
                            <td colspan="2">{{ $operation->spot->alarmed->name }}</td>
                        </tr>
                    </table>
                    <hr>
                    <h5 class="my-4 fw-bolder">DETAILS OF INVESTIGATION</h5>
                    <div class="ps-5">
                        {!! $operation->spot->details !!}
                    </div>
                    <hr>

                    <h5 class="my-4 fw-bolder">DISPOSITION</h5>
                    <div class="ps-5">
                        {!! $operation->spot->disposition !!}
                    </div>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#viewOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i> View
                        Operation</button>

                    @if ($operation->minimal)
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#viewMinimalOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i>
                            View
                            Minimal</button>
                    @endif
                    @if ($operation->spot->progress)
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#viewProgressOperationModal{{ $operation->id }}"><i
                                class="ti ti-eye"></i> View
                            Progress</button>
                    @endif
                    @if ($operation->spot->final)
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                            data-bs-target="#viewFinalOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i>
                            View Final</button>
                    @endif

                    <a href="{{ route('investigation.spot.print', ['spot' => $operation->spot->id]) }}"
                        type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    @if ($operation->spot->progress)
        <div class="modal fade" tabindex="-1" id="viewProgressOperationModal{{ $operation->id }}">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header pt-4 px-4 pb-1">
                        <h3 class="modal-title fw-bolder text-primary">
                            {{ $operation->spot->progress->investigation->subject }}</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body pt-4 px-4 pt-0">
                        <div class="row p-2">
                            <div class="col-sm-2 text-dark">For:</div>
                            <div class="col-sm-10"><b>{{ $operation->spot->progress->investigation->for }}</b></div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-2 text-dark">Subject:</div>
                            <div class="col-sm-10"><b>{{ $operation->spot->progress->investigation->subject }}</b>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-2 text-dark">Date:</div>
                            <div class="col-sm-10"><b>{{ $operation->spot->progress->investigation->date }}</b></div>
                        </div>
                        <hr>

                        <h5 class="my-4 fw-bolder">AUTHORITY:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->progress->authority !!}
                        </div>
                        <hr>

                        <h5 class="my-4 fw-bolder">MATTERS INVESTIGATED:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->progress->matters_investigated !!}
                        </div>
                        <hr>
                        <h5 class="my-4 fw-bolder">FACTS OF THE CASE:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->progress->facts_of_the_case !!}
                        </div>
                        <hr>
                        <h5 class="my-4 fw-bolder">DISPOSITION:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->progress->disposition !!}
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#viewOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i> View
                            Operation</button>

                        @if ($operation->minimal)
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#viewMinimalOperationModal{{ $operation->id }}"><i
                                    class="ti ti-eye"></i>
                                View
                                Minimal</button>
                        @endif
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#viewSpotOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i>
                            View Spot</button>
                        @if ($operation->spot->final)
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#viewFinalOperationModal{{ $operation->id }}"><i
                                    class="ti ti-eye"></i> View
                                Final</button>
                        @endif
                        <a href="{{ route('investigation.progress.print', ['progress' => $operation->spot->progress->id]) }}"
                            type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>

                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($operation->spot->final)
        <div class="modal fade" tabindex="-1" id="viewFinalOperationModal{{ $operation->id }}">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header pt-4 px-4 pb-1">
                        <h3 class="modal-title fw-bolder text-primary">
                            {{ $operation->spot->final->investigation->subject . ' ' }}
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body pt-4 px-4 pt-0">
                        <div class="row p-2">
                            <div class="col-sm-2 text-dark">Case Number:</div>
                            <div class="col-sm-10"><b>{{ $operation->spot->final->investigation->case_number }}</b>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-2 text-dark">For:</div>
                            <div class="col-sm-10"><b>{{ $operation->spot->final->investigation->for }}</b></div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-2 text-dark">Subject:</div>
                            <div class="col-sm-10"><b>{{ $operation->spot->final->investigation->subject }}</b></div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-2 text-dark">Date:</div>
                            <div class="col-sm-10"><b>{{ $operation->spot->final->investigation->date }}</b></div>
                        </div>
                        <hr>

                        <table class="table">
                            <tr>
                                <th colspan="2">FINAL INVESTIGATION REPORT</th>
                                <td colspan="4">(F.I.R.)</td>
                            </tr>
                            <tr>
                                <th colspan="2">INVESTIGATION AND INTELLIGENCE UNIT</th>
                                <td colspan="2">{{ $operation->spot->final->intelligence_unit }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">01. PLACE OF FIRE:</th>
                                <td colspan="2">{{ $operation->spot->final->place_of_fire }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">02. TIME AND DATE OF ALARM:</th>
                                @php
                                    $td = explode(' ', $operation->spot->final->td_alarm);

                                @endphp
                                {{-- {{dd($td);}} --}}
                                <td colspan="2">{{ $td[0] . ' ' . date('F d, Y', strtotime($td[1])) }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">03. ESTABLISHMENT BURNED:</th>
                                <td colspan="2">{{ $operation->spot->final->establishment_burned }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">04. FIRE VICTIM/S:</th>
                                <td colspan="2">
                                    @unless (count($operation->spot->final->investigation->victims) == 0)
                                        @foreach ($operation->spot->final->investigation->victims as $victim)
                                            <p>{{ $victim->name }}</p>
                                        @endforeach
                                    @else
                                        <p class="fw-bold">None Found</p>
                                    @endunless

                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">05. DAMAGE PROPERTY:</th>
                                <td colspan="2">
                                    {{ '₱ ' . number_format($operation->spot->final->damage_to_property, 0, '.', ',') }}
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">06. ORIGIN OF FIRE:</th>
                                <td class="text-break" colspan="2">{!! $operation->spot->final->origin_of_fire !!}</td>
                            </tr>
                            <tr>
                                <th colspan="2">07. CAUSE OF FIRE:</th>
                                <td class="text-break" colspan="2">{!! $operation->spot->final->cause_of_fire !!}</td>
                            </tr>
                        </table>
                        <hr>
                        <h5 class="my-4 fw-bolder">08. SUBSTANTIATING DOCUMENTS:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->final->substantiating_documents !!}
                        </div>
                        <hr>
                        <h5 class="my-4 fw-bolder">FACTS OF THE CASE:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->final->facts_of_the_case !!}
                        </div>
                        <hr>
                        <h5 class="my-4 fw-bolder">DISCUSSION:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->final->discussion !!}
                        </div>
                        <hr>
                        <h5 class="my-4 fw-bolder">FINDINGS:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->final->findings !!}
                        </div>
                        <hr>
                        <h5 class="my-4 fw-bolder">RECOMMENDATION:</h5>
                        <div class="ps-5">
                            {!! $operation->spot->final->recommendation !!}
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#viewOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i> View
                            Operation</button>
                        @if ($operation->minimal)
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#viewMinimalOperationModal{{ $operation->id }}"><i
                                    class="ti ti-eye"></i>
                                View
                                Minimal</button>
                        @endif
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#viewSpotOperationModal{{ $operation->id }}"><i class="ti ti-eye"></i>
                            View Spot</button>
                        @if ($operation->spot->progress)
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#viewProgressOperationModal{{ $operation->id }}"><i
                                    class="ti ti-eye"></i> View Progress</button>
                        @endif
                        <a href="{{ route('investigation.final.print', ['final' => $operation->spot->final->id]) }}"
                            type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>

                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
