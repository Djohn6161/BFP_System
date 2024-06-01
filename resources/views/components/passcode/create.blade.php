<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addPasscodeModal" tabindex="-1" aria-labelledby="addPasscodeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.passcode.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRankModalLabel">Create Passcode</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Type:</label>
                        <select name="type" class="form-control"> 
                            <option value="">Select Type</option>
                            <option value="OC">Operation Clerk</option>
                            <option value="IC">Investigation Clerk</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Action:</label>
                        <select name="action" class="form-control">
                            <option value="">Select Action</option>
                            <option value="update">Update</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">New Passcode:</label>
                        <input type="text" class="form-control" name="passcode">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Passcode</button>
                </div>
            </form>
        </div>
    </div>
</div>
