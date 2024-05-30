<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteAlarmModalll{{ $list->id }}" tabindex="-1" aria-labelledby="deleteAlarmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteAlarmModalLabel">Delete Alarm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p>Are you sure you want to delete this alarm?</p>

                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('admin.alarms.delete', ['id' => $list->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                        <form method="POST" action="{{ route('admin.alarms.delete', ['id' => $list->id]) }}" enctype="multipart/form-data">

                    </div>
        </div>
    </div>
</div>
