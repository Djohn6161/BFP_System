    <div class="modal fade" id="chooseInvestigation" tabindex="-1" aria-labelledby="noModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="noModalLabel">Choose Investigation Report</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2"
                        data-bs-toggle="modal" data-bs-target="#minimalTableModal">Minimal</button>
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2"
                        data-bs-toggle="modal" data-bs-target="#spotTableModal">Spot</button>
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2"
                        onclick="progress(this)">Progress</button>
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2"
                        onclick="final(this)">Final</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Minimal Table Modal --}}
    <div class="modal fade" id="minimalTableModal" tabindex="-1" aria-labelledby="minimalTableModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="minimalTableModalLabel">Minimal - Operation Reports</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle w-100" id="minimalModalTable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th>Alarm Received</th>
                                    <th>Transmitted By</th>
                                    <th>Location</th>
                                    <th>Time/Date Under Control</th>
                                    <th>Time/Date Declared Fireout</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sortedAfors = $afors->sortByDesc(function ($item) {
                                        return \Carbon\Carbon::parse($item->td_under_control);
                                    });
                                @endphp

                                @foreach ($sortedAfors as $item)
                                    <tr>
                                        <td>{{ $item->alarm_received }}</td>
                                        <td>{{ $item->transmitted_by }}</td>
                                        <td> {{ $item->full_location }} </td>
                                        <td> {{ $item->td_under_control }} </td>
                                        <td> {{ $item->td_declared_fireout }} </td>
                                        <td>

                                            @if ($item->spot || $item->minimal)
                                                <button disabled type="button"
                                                    class="disabled btn btn-primary hide-menu w-100 mb-1">
                                                    <i class="ti ti-x"></i>
                                                    Not Applicable
                                                </button>
                                            @else
                                                <a href="{{ route('investigation.minimal.create', ['afor' => $item->id]) }}"
                                                    class=" btn btn-primary hide-menu w-100 mb-1">
                                                    <i class="ti ti-check"></i>
                                                    Apply
                                                </a>
                                            @endif

                                            {{-- <button disabled></button> --}}
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

    {{-- Spot Table Modal --}}
    <div class="modal fade" id="spotTableModal" tabindex="-1" aria-labelledby="spotTableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="spotTableModalLabel">Spot - Operation Reports</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle w-100" id="spotModalTable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th>Alarm Received</th>
                                    <th>Transmitted By</th>
                                    <th>Location</th>
                                    <th>Time/Date Under Control</th>
                                    <th>Time/Date Declared Fireout</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sortedAfors = $afors->sortByDesc(function ($item) {
                                        return \Carbon\Carbon::parse($item->td_under_control);
                                    });
                                @endphp

                                @foreach ($sortedAfors as $item)
                                    <tr>
                                        <td>{{ $item->alarm_received }}</td>
                                        <td>{{ $item->transmitted_by }}</td>
                                        <td> {{ $item->full_location }} </td>
                                        <td> {{ $item->td_under_control }} </td>
                                        <td> {{ $item->td_declared_fireout }} </td>
                                        <td>
                                            @if ($item->spot || $item->minimal)
                                                <button disabled type="button"
                                                    class="disabled btn btn-primary hide-menu w-100 mb-1">
                                                    <i class="ti ti-x"></i>
                                                    Not Applicable
                                                </button>
                                            @else
                                                <a href="{{ route('investigation.spot.create', ['afor' => $item->id]) }}"
                                                    class="btn btn-primary hide-menu w-100 mb-1">
                                                    <i class="ti ti-check"></i>
                                                    Apply
                                                </a>
                                            @endif
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
                        <table class="table w-100 " id="progressModalTable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th>Id</th>
                                    <th>For</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sortedSpots = $spots->sortByDesc(function ($spot) {
                                        return \Carbon\Carbon::parse($spot->investigation->date);
                                    });
                                @endphp

                                @foreach ($sortedSpots as $spot)
                                    <tr>
                                        <td>{{ $spot->id }}</td>
                                        <td>{{ $spot->investigation->for }}</td>
                                        <td>{{ $spot->investigation->subject }}</td>
                                        <td>{{ $spot->investigation->date }}</td>
                                        <td>
                                            <a href="{{ route('investigation.progress.create', ['spot' => $spot->id]) }}"
                                                class="btn btn-primary w-100 mb-1"><i class="ti ti-check"></i> Apply</a>
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
                        <table class="table w-100 " id="finalModalTable">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th>Id</th>
                                    <th>For</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sortedSpots = $spots->sortByDesc(function ($spot) {
                                        return \Carbon\Carbon::parse($spot->investigation->date);
                                    });
                                @endphp

                                @foreach ($sortedSpots as $spot)
                                    <tr>
                                        <td>{{ $spot->id }}</td>
                                        <td>{{ $spot->investigation->for }}</td>
                                        <td>{{ $spot->investigation->subject }}</td>
                                        <td>{{ $spot->investigation->date }}</td>
                                        <td>
                                            <a href="{{ route('investigation.final.create', ['spot' => $spot->id]) }}"
                                                class="btn btn-primary w-100 mb-1"><i class="ti ti-check"></i>
                                                Apply</a>
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
