<!-- View Operation  -->
<div class="modal fade" data-bs-backdrop="static" id="viewModal{{ $report->id }}" tabindex="-1"
    aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    @php
                                        if ($report->photos ?? false) {
                                            $photos = explode(', ', $report->photos);

                                            # code...
                                        }
                                        // dd($photos);
                                    @endphp
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Category:</strong> {{ $report->category }}
                                        </li>
                                        <li class="list-group-item"><strong>Type:</strong> {{ $report->type }}</li>
                                        <li class="list-group-item"><strong>Team Leader:</strong>
                                            {{ $report->personRank($report->teamLeader->ranks_id)->slug . ' ' . $report->teamLeader->last_name . ', ' . $report->teamLeader->first_name }}
                                        </li>
                                        <li class="list-group-item"><strong>Driver:</strong>
                                            {{ $report->personRank($report->driver->ranks_id)->slug . ' ' . $report->driver->last_name }}
                                        </li>
                                        <li class="list-group-item"><strong>Location:</strong>
                                            {{ $report->barangay->name ?? $report->otherLocation }}</li>
                                        <li class="list-group-item"><strong>Date and time of Departure from
                                                Station:</strong> {{ $report->time_of_departure }}</li>
                                        <li class="list-group-item"><strong>Date and time of Arrival to Scene:</strong>
                                            {{ $report->time_of_arrival_to_scene }}</li>
                                        <li class="list-group-item"><strong>Date and time of Arrival to
                                                Station:</strong> {{ $report->time_of_arrival_to_station }}</li>
                                        <li class="list-group-item"><strong>Property Involved:</strong>
                                            {{ $report->property_involved }}</li>
                                        <li class="list-group-item"><strong>Estimated Cost of Damages:</strong>
                                            {{ $report->estimate_cost_of_damages }}</li>
                                        <li class="list-group-item"><strong>Remarks:</strong> {{ $report->remarks }}
                                        </li>
                                        <li class="list-group-item"><strong>Photos:</strong>
                                            <div class="row mt-3">
                                                @if ($report->photos ?? false)
                                                    @foreach ($photos as $photo)
                                                        <div class="col-md-4 mb-3">
                                                            <a href="{{ asset('storage/' . $photo) }}" data-toggle="lightbox" data-gallery="gallery">
                                                                <img src="{{ asset('storage/' . $photo) }}" class="img-thumbnail object-fit-cover w-100" style="height: 300px" alt="">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>                                            
                                        </li>
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