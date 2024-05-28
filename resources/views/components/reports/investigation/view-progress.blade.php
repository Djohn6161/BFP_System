<div class="modal fade" tabindex="-1" id="viewProgressModal{{ $investigation->id }}">
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

                <h5 class="my-4 fw-bolder">AUTHORITY:</h5>
                <div class="ps-5">
                    {!! $investigation->authority !!}
                </div>
                <hr>

                <h5 class="my-4 fw-bolder">MATTERS INVESTIGATED:</h5>
                <div class="ps-5">
                    {!! $investigation->matters_investigated !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FACTS OF THE CASE:</h5>
                <div class="ps-5">
                    {!! $investigation->facts_of_the_case !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">DISPOSITION:</h5>
                <div class="ps-5">
                    {!! $investigation->disposition !!}
                </div>
                <hr>
            </div>
            <div class="modal-footer">

                @if ($investigation->spot)
                    @if ($investigation->spot->operation)
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#viewOperationModal{{ $investigation->investigation_id }}"><i
                                class="ti ti-files"></i> View Operation</button>
                    @endif
                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                        data-bs-target="#viewSpotProgressModal{{ $investigation->investigation_id }}">View Spot</button>
                    @if ($investigation->spot->final)
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#viewFinalProgressModal{{ $investigation->investigation_id }}">View
                            Final</button>
                    @endif
                @endif
                <a href="{{ route('investigation.progress.print', ['progress' => $investigation->id]) }}" type="button"
                    class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>

                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
@if ($investigation->spot)
    @if ($investigation->spot->operation)
        <x-reports.investigation.view-operation :act="'progress'" :investigation=$investigation :operation="$investigation->spot->afor"
            :responses=$responses :personnels=$personnels></x-reports.investigation.view-operation>
    @endif
    
    <x-reports.investigation.view-progress-spot
        :investigation=$investigation :spot="$investigation->spot"></x-reports.investigation.view-progress-spot>

    @if ($investigation->spot->final)
        <x-reports.investigation.view-progress-final :investigation=$investigation
            :final="$investigation->spot->final"></x-reports.investigation.view-progress-final>
    @endif
@endif
