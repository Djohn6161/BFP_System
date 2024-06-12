<div class="modal fade" tabindex="-1" id="viewInvestigationLogs{{ $log->id }}">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h4 class="modal-title fw-bolder text-primary">Investigation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body px-4 py-3">
                <table class="table table-striped">
                    <tr>
                        <th>Made Changes</th>
                        <td class="text-break">
                            @if ($log->action == 'Delete')
                                <div class="text-light rounded-pill  bg-danger p-2 text-center" style="width: 70px;">
                                    {{ $log->action }}</div>
                            @elseif($log->action == 'Update')
                                <div class="text-light rounded-pill bg-success p-2 text-center" style="width: 70px;">
                                    {{ $log->action }}</div>
                            @elseif($log->action == 'Store')
                                <div class="text-light rounded-pill bg-primary p-2 text-center" style="width: 70px;">
                                    {{ $log->action }}</div>
                            @else
                                <div class="rounded-pill p-2" style="width: 70px;">{{ $log->action }}
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Date and Time</th>
                        <td class="text-break">{{ $log->updated_at }}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td class="text-break">{{ $log->user->name }}</< /td>
                    </tr>
                    <tr>
                        <th>Investigation ID</th>
                        <td class="text-break">{{ $log->investigation->id }} - @if ($log->investigation->spot)
                                Spot
                            @elseif($log->investigation->minimal)
                                Minimal<div class="modal fade" tabindex="-1"
                                    id="viewInvestigationLogs{{ $log->id }}">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header pt-4 px-4 pb-1">
                                                <h4 class="modal-title fw-bolder text-primary">Investigation</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <hr>
                                            <div class="modal-body px-4 py-3">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th>Made Changes</th>
                                                        <td class="text-break">
                                                            @if ($log->action == 'Delete')
                                                                <div class="text-light rounded-pill  bg-danger p-2 text-center"
                                                                    style="width: 70px;">
                                                                    {{ $log->action }}</div>
                                                            @elseif($log->action == 'Update')
                                                                <div class="text-light rounded-pill bg-success p-2 text-center"
                                                                    style="width: 70px;">
                                                                    {{ $log->action }}</div>
                                                            @elseif($log->action == 'Store')
                                                                <div class="text-light rounded-pill bg-primary p-2 text-center"
                                                                    style="width: 70px;">
                                                                    {{ $log->action }}</div>
                                                            @else
                                                                <div class="rounded-pill p-2" style="width: 70px;">
                                                                    {{ $log->action }}
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date and Time</th>
                                                        <td class="text-break">{{ $log->updated_at }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>User</th>
                                                        <td class="text-break">{{ $log->user->name }}</< /td>
                                                    </tr>
                                                    <tr>
                                                        <th>Investigation ID</th>
                                                        <td class="text-break">{{ $log->investigation->id }} -
                                                            @if ($log->investigation->spot)
                                                                Spot
                                                            @elseif($log->investigation->minimal)
                                                                Minimal
                                                            @elseif($log->investigation->progress)
                                                                Progress
                                                            @elseif($log->investigation->final)
                                                                Final
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Investigation Date</th>
                                                        <td class="text-break">
                                                            {{ $log->investigation != null ? $log->investigation->date : 'Unavailable' }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <hr>
                                                <div class="px-4 py-2 bg-secondary">
                                                    <h6 class="h3 my-4 fw-bolder">Details</h6>
                                                    <p>
                                                        @if ($log->action == 'Update')
                                                            @php
                                                                $changes = json_decode($log->details, true);
                                                                // dd($changes);
                                                            @endphp
                                                            @foreach ($changes as $column => $change)
                                                                <h6 class="text-capitalize text-primary">
                                                                    <strong>{{ $column }}</strong></h6>
                                                                <p>
                                                                    <b><i>FROM: </i></b> "{{ ' ' . $change['old'] }}"
                                                                    <br> <b><i>TO: </i></b>"{!! $change['new'] !!}"<br>
                                                                </p>
                                                            @endforeach
                                                        @else
                                                            {!! $log->details !!}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($log->investigation->progress)
                                Progress
                            @elseif($log->investigation->final)
                                Final
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Investigation Date</th>
                        <td class="text-break">
                            {{ $log->investigation != null ? $log->investigation->date : 'Unavailable' }}</td>
                    </tr>
                </table>
                <hr>
                <div class="px-4 py-2 bg-secondary">
                    <h6 class="h3 my-4 fw-bolder">Details</h6>
                    <p>
                        @if ($log->action == 'Update')
                            @php
                                $changes = json_decode($log->details, true);
                                // dd($changes);
                            @endphp
                            @foreach ($changes as $column => $change)
                                <h6 class="text-capitalize text-primary"><strong>{{ $column }}</strong></h6>
                                <p>
                                    <b><i>FROM: </i></b> "{{ ' ' . $change['old'] }}" <br> <b><i>TO:
                                        </i></b>"{!! $change['new'] !!}"<br>
                                </p>
                            @endforeach
                        @else
                            {!! $log->details !!}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
