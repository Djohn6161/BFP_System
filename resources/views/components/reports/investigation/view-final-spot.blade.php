<div class="modal fade" tabindex="-1" id="viewSpotFinalModal{{$investigation->investigation_id}}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h3 class="modal-title fw-bolder text-primary">{{ $spot->investigation->subject }} (FINAL SPOT)</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body pt-4 px-4 pt-0">
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">For:</div>
                    <div class="col-sm-10"><b>{{ $spot->investigation->for }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Subject:</div>
                    <div class="col-sm-10"><b>{{ $spot->investigation->subject }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Date:</div>
                    <div class="col-sm-10"><b>{{ $spot->investigation->date }}</b></div>
                </div>
                <hr>

                <table class="table">
                    <tr>
                        @php
                            if ($spot->landmark == null || $spot->landmark == '') {
                                $location = $spot->address_occurence;
                            } else {
                                $location = $spot->landmark;
                            }
                        @endphp
                        <th colspan="2">DTPO</th>
                        <td colspan="4">
                            {{ $spot->date_occurence . ', ' . $spot->time_occurence . ', ' . $location }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">INVOLVED</th>
                        <td colspan="2">{{ $spot->involved }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">NAME OF ESTABLISHMENT</th>
                        <td colspan="2">{{ $spot->name_of_establishment }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">OWNER</th>
                        <td colspan="2">{{ $spot->owner }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">OCCUPANT</th>
                        <td colspan="2">{{ $spot->occupant }}</td>
                    </tr>
                    <tr>
                        <th rowspan="2">CASUALTY</th>
                        <th>Fatality</th>
                        <td>{{ $spot->fatality != 0 ? $spot->fatality : 'Negative' }}</td>
                    </tr>
                    <tr>
                        <th>Injured</th>
                        <td>{{ $spot->injured != 0 ? $spot->injured : 'Negative' }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">ESTIMATED DAMAGE</th>
                        <td colspan="2">{{ '₱ ' . number_format($spot->estimate_damage, 0, '.', ',') }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">TIME FIRE STARTED</th>
                        <td colspan="2">{{ $spot->time_fire_start }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">TIME OF FIRE OUT</th>
                        <td colspan="2">{{ $spot->time_fire_out }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">ALARM</th>
                        <td colspan="2">{{ $spot->alarmed->name }}</td>
                    </tr>
                </table>
                <hr>
                <h5 class="my-4 fw-bolder">DETAILS OF INVESTIGATION</h5>
                <div class="ps-5">
                    {!! $spot->details !!}
                </div>
                <hr>

                <h5 class="my-4 fw-bolder">DISPOSITION</h5>
                <div class="ps-5">
                    {!! $spot->disposition !!}
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewFinalModal{{ $investigation->id }}"><span><i class="ti ti-arrow-back"></i></span><span> Go Back</span></button>
                {{-- <a href="#" type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a> --}}
            </div>
        </div>
    </div>
</div>