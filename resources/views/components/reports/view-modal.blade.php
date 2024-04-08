<!-- View Operation  -->
<div class="modal fade" data-bs-backdrop="static" id="viewModal{{$report->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            {{-- @foreach ($reports as $report) --}}
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-primary">{{ $report->name }}</h4>
                                        <span class="btn btn-primary w-10 d-flex">Print</span>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Type:</strong> {{ $report->type }}</li>
                                        <li class="list-group-item"><strong>Team Leader:</strong> {{ $report->personRank($report->teamLeader->ranks_id)->slug . ' ' . $report->teamLeader->last_name .', ' . $report->teamLeader->first_name  }}</li>
                                        <li class="list-group-item"><strong>Driver:</strong> {{ $report->personRank($report->driver->ranks_id)->slug . ' ' . $report->driver->last_name }}</li>
                                        <li class="list-group-item"><strong>Location:</strong> {{ $report->otherLocation != '' ? $report->otherLocation : $report->barangay->name . ', ' . $report->street }}</li>
                                        <li class="list-group-item"><strong>Departure From Station:</strong> {{ $report->time_of_departure }}</li>
                                        <li class="list-group-item"><strong>Arrival to Station:</strong> {{ $report->time_of_arrival_to_station }}</li>
                                    </ul>
                                </div>
                            </div>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>