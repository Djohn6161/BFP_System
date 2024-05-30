<div class="modal fade" tabindex="-1" id="viewFinalModal{{ $investigation->id }}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h3 class="modal-title fw-bolder text-primary">{{ $investigation->investigation->subject }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body pt-4 px-4 pt-0">
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
                        <th colspan="2">FINAL INVESTIGATION REPORT</th>
                        <td colspan="4">(F.I.R.)</td>
                    </tr>
                    <tr>
                        <th colspan="2">INVESTIGATION AND INTELLIGENCE UNIT</th>
                        <td colspan="2">{{ $investigation->intelligence_unit }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">01. PLACE OF FIRE:</th>
                        <td colspan="2">{{ $investigation->place_of_fire }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">02. TIME AND DATE OF ALARM:</th>
                        @php
                            $td = explode(' ', $investigation->td_alarm);

                        @endphp
                        {{-- {{dd($td);}} --}}
                        <td colspan="2">{{ $td[0] . ' ' . date('F d, Y', strtotime($td[1])) }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">03. ESTABLISHMENT BURNED:</th>
                        <td colspan="2">{{ $investigation->establishment_burned }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">04. FIRE VICTIM/S:</th>
                        <td colspan="2">
                            @unless (count($investigation->investigation->victims) == 0)
                                @foreach ($investigation->investigation->victims as $victim)
                                    <p>{{ $victim->name }}</p>
                                @endforeach
                            @else
                                <p class="fw-bold">None Found</p>
                            @endunless

                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">05. DAMAGE PROPERTY:</th>
                        <td colspan="2">{{ '₱ ' . number_format($investigation->damage_to_property, 0, '.', ',') }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">06. ORIGIN OF FIRE:</th>
                        <td class="text-break" colspan="2">{!! $investigation->origin_of_fire !!}</td>
                    </tr>
                    <tr>
                        <th colspan="2">07. CAUSE OF FIRE:</th>
                        <td class="text-break" colspan="2">{!! $investigation->cause_of_fire !!}</td>
                    </tr>
                </table>
                <hr>
                <h5 class="my-4 fw-bolder">08. SUBSTANTIATING DOCUMENTS:</h5>
                <div class="ps-5">
                    {!! $investigation->substantiating_documents !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FACTS OF THE CASE:</h5>
                <div class="ps-5">
                    {!! $investigation->facts_of_the_case !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">DISCUSSION:</h5>
                <div class="ps-5">
                    {!! $investigation->discussion !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FINDINGS:</h5>
                <div class="ps-5">
                    {!! $investigation->findings !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">RECOMMENDATION:</h5>
                <div class="ps-5">
                    {!! $investigation->recommendation !!}
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#viewOperationModal{{ $investigation->investigation_id }}"><i
                        class="ti ti-eye"></i> View Operation</button>
                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target="#viewProgressFinalModal{{ $investigation->investigation_id }}"><i
                        class="ti ti-eye"></i> View Progress</button>
                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target="#viewSpotFinalModal{{ $investigation->investigation_id }}"><i
                        class="ti ti-eye"></i> View Spot</button>
                <a href="{{ route('investigation.final.print', ['final' => $investigation->id]) }}" type="button"
                    class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>

                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
@if ($investigation->spot)

    @if ($investigation->spot->afor)
        <x-reports.investigation.view-operation :act="'final'" :investigation=$investigation :operation="$investigation->spot->afor"
            :responses=$responses :personnels=$personnels></x-reports.investigation.view-operation>
    @endif
    <x-reports.investigation.view-final-spot :investigation=$investigation
        :spot="$investigation->spot"></x-reports.investigation.view-final-spot>
    @if ($investigation->spot->progress)
        <x-reports.investigation.view-final-progress :investigation=$investigation
            :progress="$investigation->spot->progress"></x-reports.investigation.view-final-progress>
    @endif
@endif
