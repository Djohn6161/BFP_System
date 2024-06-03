<div class="modal fade" tabindex="-1" id="viewOperationLogs{{ $log->id }}">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h4 class="modal-title fw-bolder text-primary">Operation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body px-4 py-3">
                <table class="table table-striped">
                    <tr>
                        <th>Made Changes</th>
                        <td class="text-break">
                            @if ($log->action == 'Delete')
                                <div class="text-light rounded-pill bg-danger p-2 text-center " style="width: 70px;">
                                    {{ $log->action }}</div>
                            @elseif($log->action == 'Update')
                                <div class="text-light rounded-pill bg-success p-2 text-center " style="width: 70px;">
                                    {{ $log->action }}</div>
                            @elseif($log->action == 'Store')
                                <div class="text-light rounded-pill bg-primary p-2 text-center " style="width: 70px;">
                                    {{ $log->action }}</div>
                            @else
                                <div class="rounded-pill p-2 text-center " style="width: 70px;">{{ $log->action }}
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
                        <th>Alarm recieved</th>
                        <td>{{ $log->afor != null ? $log->afor->alarm_received : 'Unavailable' }}</td>
                    </tr>
                </table>
                <hr>
                <div class="bg-secondary px-4 py-2">
                    <h3 class="my-4 fw-bolder">Details</h3>
                    <p>{!! $log->details !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>