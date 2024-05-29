<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editAlarmModal{{ $list->id }}" tabindex="-1" aria-labelledby="editAlarmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.alarms.update', ['id' => $list->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAlarmModalLabel">Update Alarm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Alarm Name:</label>
                        <input type="text" class="form-control" value="{{ $list->name }}" id="name" name="name" placeholder="Enter Name">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Alarm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
