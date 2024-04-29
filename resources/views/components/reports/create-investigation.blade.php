    <div class="modal fade" id="chooseInvestigation" tabindex="-1" aria-labelledby="noModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="noModalLabel">Choose Investigation Report</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{route('investigation.minimal.create')}}" class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Minimal</a>
                    <a href="{{route('investigation.spot.create')}}" class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Spot</a>
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2" onclick="progress(this)">Progress</button>
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2" onclick="final(this)">Final</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Modal (Spot table for progress) -->
<div class="modal fade" id="spotTableProgress" tabindex="-1" aria-labelledby="yesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3 text-center">
                <h3 class="mb-2">Spot Reports - Progress</h3>
                <div class="shadow rounded p-4">
                    <table class="table w-100 " id="spotJTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">For</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Subject</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spots as $spot)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$spot->id}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-capitalize">
                                            {{$spot->investigation->for}}
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-capitalize">
                                            {{$spot->investigation->subject}}
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-capitalize">
                                            {{$spot->investigation->date}}
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="{{route('investigation.progress.create', ['spot' => $spot->id])}}" class="btn btn-primary w-100 mb-1">apply</a>
                                    </td>
                                </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Second Modal (Spot table for final) -->
<div class="modal fade" id="spotTableFinal" tabindex="-1" aria-labelledby="yesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3 text-center">
                <h3 class="mb-2">Spot Reports - Final</h3>
                <div class="shadow rounded p-4">
                    <table class="table w-100 " id="spotJTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">For</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Subject</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spots as $spot)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{$spot->id}}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 text-capitalize">
                                        {{$spot->investigation->for}}
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal text-capitalize">
                                        {{$spot->investigation->subject}}
                                    </p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal text-capitalize">
                                        {{$spot->investigation->date}}
                                    </p>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="{{route('investigation.final.create', ['spot', $spot->id])}}" class="btn btn-primary w-100 mb-1">apply</a>
                                </td>
                            </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

