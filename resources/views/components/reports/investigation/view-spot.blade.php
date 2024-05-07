<div class="modal fade" tabindex="-1" id="viewSpotModal{{ $investigation->id }}">
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

                <table class="table">
                    <tr>
                        @php
                            if ($investigation->landmark == null || $investigation->landmark == '') {
                                $location = $investigation->address_occurence;
                            } else {
                                $location = $investigation->landmark;
                            }
                        @endphp
                        <th colspan="2">DTPO</th>
                        <td colspan="4">
                            {{ $investigation->date_occurence . ', ' . $investigation->time_occurence . ', ' . $location }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">INVOLVED</th>
                        <td colspan="2">{{ $investigation->involved }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">NAME OF ESTABLISHMENT</th>
                        <td colspan="2">{{ $investigation->name_of_establishment }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">OWNER</th>
                        <td colspan="2">{{ $investigation->owner }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">OCCUPANT</th>
                        <td colspan="2">{{ $investigation->occupant }}</td>
                    </tr>
                    <tr>
                        <th rowspan="2">CASUALTY</th>
                        <th>Fatality</th>
                        <td>{{ $investigation->fatality != 0 ? $investigation->fatality : 'Negative' }}</td>
                    </tr>
                    <tr>
                        <th>Injured</th>
                        <td>{{ $investigation->injured != 0 ? $investigation->injured : 'Negative' }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">ESTIMATED DAMAGE</th>
                        <td colspan="2">{{'₱ ' . number_format($investigation->estimate_damage, 0, '.', ','); }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">TIME FIRE STARTED</th>
                        <td colspan="2">{{ $investigation->time_fire_start }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">TIME OF FIRE OUT</th>
                        <td colspan="2">{{ $investigation->time_fire_out }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">ALARM</th>
                        <td colspan="2">{{ $investigation->alarmed->name }}</td>
                    </tr>
                </table>
                <hr>
                <h5 class="my-4 fw-bolder">DETAILS OF INVESTIGATION</h5>
                <div class="ps-5">
                    {!! $investigation->details !!}
                </div>
                <hr>

                <h5 class="my-4 fw-bolder">DISPOSITION</h5>
                <div class="ps-5">
                    {!! $investigation->disposition !!}
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
