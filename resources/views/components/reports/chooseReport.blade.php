<!-- Second Modal (Yes Modal) -->
<div class="modal fade" id="yesModal" tabindex="-1" aria-labelledby="yesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3 text-center">
                <h3 class="mb-2">{{$category}} Reports</h3>
                <div class="shadow rounded p-4">
                    <table class="table w-100 " id="myTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Team Leader</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Type</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Driver</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Departure From Station</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Arrival to Station</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $report->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-capitalize">
                                            {{ $report->personRank($report->teamLeader->ranks_id)->slug . ' ' . $report->teamLeader->last_name }}
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $report->type }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-capitalize">
                                            {{ $report->personRank($report->driver->ranks_id)->slug . ' ' . $report->driver->last_name }}
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $report->time_of_departure }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $report->time_of_arrival_to_station }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="{{route('report.create', ['id' => $report->id, 'type' => $report->type, 'category' => $category])}}" class="btn btn-primary w-100 mb-1">apply</a>
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