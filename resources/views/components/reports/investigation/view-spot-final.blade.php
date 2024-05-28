<div class="modal fade" tabindex="-1" id="viewSpotFinalModal{{$investigation->investigation_id}}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h3 class="modal-title fw-bolder text-primary">{{ $final->investigation->subject }} (FINAL SPOT)</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body pt-4 px-4 pt-0">
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">For:</div>
                    <div class="col-sm-10"><b>{{ $final->investigation->for }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Subject:</div>
                    <div class="col-sm-10"><b>{{ $final->investigation->subject }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Date:</div>
                    <div class="col-sm-10"><b>{{ $final->investigation->date }}</b></div>
                </div>
                <hr>

                <table class="table">
                    <tr>
                        <th colspan="2">FINAL INVESTIGATION REPORT</th>
                        <td colspan="4">(F.I.R.)</td>
                    </tr>
                    <tr>
                        <th colspan="2">INVESTIGATION AND INTELLIGENCE UNIT</th>
                        <td colspan="2">{{ $final->intelligence_unit }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">01. PLACE OF FIRE:</th>
                        <td colspan="2">{{ $final->place_of_fire }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">02. TIME AND DATE OF ALARM:</th>
                        @php
                            $td = explode(' ', $final->td_alarm);

                        @endphp
                        {{-- {{dd($td);}} --}}
                        <td colspan="2">{{ $td[0] . ' ' . date('F d, Y', strtotime($td[1])) }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">03. ESTABLISHMENT BURNED:</th>
                        <td colspan="2">{{ $final->establishment_burned }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">04. FIRE VICTIM/S:</th>
                        <td colspan="2">
                            @unless (count($final->investigation->victims) == 0)
                                @foreach ($final->investigation->victims as $victim)
                                    <p>{{ $victim->name }}</p>
                                @endforeach
                            @else
                                <p class="fw-bold">None Found</p>
                            @endunless

                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">05. DAMAGE PROPERTY:</th>
                        <td colspan="2">{{ '₱ ' . number_format($final->damage_to_property, 0, '.', ',') }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">06. ORIGIN OF FIRE:</th>
                        <td class="text-break" colspan="2">{!! $final->origin_of_fire !!}</td>
                    </tr>
                    <tr>
                        <th colspan="2">07. CAUSE OF FIRE:</th>
                        <td class="text-break" colspan="2">{!! $final->cause_of_fire !!}</td>
                    </tr>
                </table>
                <hr>
                <h5 class="my-4 fw-bolder">08. SUBSTANTIATING DOCUMENTS:</h5>
                <div class="ps-5">
                    {!! $final->substantiating_documents !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FACTS OF THE CASE:</h5>
                <div class="ps-5">
                    {!! $final->facts_of_the_case !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">DISCUSSION:</h5>
                <div class="ps-5">
                    {!! $final->discussion !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FINDINGS:</h5>
                <div class="ps-5">
                    {!! $final->findings !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">RECOMMENDATION:</h5>
                <div class="ps-5">
                    {!! $final->recommendation !!}
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#viewSpotModal{{ $investigation->id }}"><span><i
                            class="ti ti-arrow-back"></i></span><span> Go Back</span></button>
                {{-- <a href="#" type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a> --}}
            </div>
        </div>
    </div>
</div>
