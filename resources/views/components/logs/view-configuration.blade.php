<div class="modal fade" tabindex="-1" id="viewConfigurationLogs{{ $log->id }}">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h4 class="modal-title fw-bolder text-primary">Configuration</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body px-4 py-3">
                <table class="table table-striped">
                    <tr>
                        <th>Made Changes</th>
                        <td class="text-break">
                            @if ($log->action == 'Delete')
                            <div class="text-light rounded-pill bg-danger p-2 text-center " style="width: 70px;">{{ $log->action }}</div>
                            @elseif($log->action == 'Update')
                            <div class="text-light rounded-pill bg-success p-2 text-center " style="width: 70px;">{{ $log->action }}</div>
                            @elseif($log->action == 'Store')
                            <div class="text-light rounded-pill bg-primary p-2 text-center " style="width: 70px;">{{ $log->action }}</div>
                            @else
                            <div class="rounded-pill p-2 text-center " style="width: 70px;">{{ $log->action }}</div>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Date and Time</th>
                        <td class="text-break">{{ $log->updated_at }}</td>
                    </tr>
                    <tr>
                        <th>ID - User</th>
                        <td class="text-break">{{ $log->user->id . " - " . $log->user->name }}</</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $log->type }}</td>
                    </tr>
                </table>
                <hr>
                <div class="px-4 py-2 bg-secondary">
                    <h6 class="h3 my-4 fw-bolder">Details</h6>
                    <p>{!! $log->Details !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>