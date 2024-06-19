<div class="modal fade" tabindex="-1" id="viewProgressFinalModal{{$investigation->investigation_id}}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h3 class="modal-title fw-bolder text-primary">Investigation Subject (FINAL PROGRESS)</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body pt-4 px-4 pt-0">
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Case Number:</div>
                    <div class="col-sm-10"><b>{{ $progress->investigation->case_number }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">For:</div>
                    <div class="col-sm-10"><b>{{ $progress->investigation->for }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Subject:</div>
                    <div class="col-sm-10"><b>{{ $progress->investigation->subject }}</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Date:</div>
                    <div class="col-sm-10"><b>{{ $progress->investigation->date }}</b></div>
                </div>
                <hr>
                
                <h5 class="my-4 fw-bolder">AUTHORITY:</h5>
                <div class="ps-5">
                    {!! $progress->authority !!}
                </div>
                <hr>

                <h5 class="my-4 fw-bolder">MATTERS INVESTIGATED:</h5>
                <div class="ps-5">
                    {!! $progress->matters_investigated !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FACTS OF THE CASE:</h5>
                <div class="ps-5">
                    {!! $progress->facts_of_the_case !!}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">DISPOSITION:</h5>
                <div class="ps-5">
                    {!! $progress->disposition !!}
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