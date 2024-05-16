<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addAlarmModal" tabindex="-1" aria-labelledby="addAlarmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addAlarmModalLabel">Create Alarm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  method="POST" action="{{ route('admin.alarms.create') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Alarm Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Alarm</button>
                </div>
            </form>
        </div>
    </div>
</div>
