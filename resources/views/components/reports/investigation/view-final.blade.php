<div class="modal fade" tabindex="-1" id="viewFinalModal{{ $investigation->id }}">
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
                        <th colspan="2">FINAL INVESTIGATION REPORT</th>
                        <td colspan="4">(F.I.R.)</td>
                    </tr>
                    <tr>
                        <th colspan="2">INVESTIGATION AND INTELLIGENCE UNIT</th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">01. PLACE OF FIRE:</th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">02. TIME AND DATE OF ALARM:</th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">03. ESTABLISHMENT BURNED:</th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">04. FIRE VICTIM/S:</th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">05. DAMAGE PROPERTY:</th>
                        <td colspan="2">Q1</td>
                    </tr>
                    <tr>
                        <th colspan="2">06. ORIGIN OF FIRE:</th>
                        <td class="text-break" colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">07. CAUSE OF FIRE:</th>
                        <td class="text-break" colspan="2">Q1</td>
                    </tr>
                </table>
                <hr>
                <h5 class="my-4 fw-bolder">08. SUBSTANTIATING DOCUMENTS:</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FACTS OF THE CASE:</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">DISCUSSION:</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">FINDINGS:</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">RECOMMENDATION:</h5>
                <div class="ps-5">
                    DETAILS HERE
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
