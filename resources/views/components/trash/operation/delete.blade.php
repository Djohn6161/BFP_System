<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteTrashOperationModal{{ $operation->id }}" tabindex="-1"
    aria-labelledby="deleteTrashOperationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteTrashOperationModalLabel">Are you sure you want to delete this
                    report permanently?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.trash.operation.delete', $operation->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="verifyDelete" class="form-label">Type your password:</label>
                        <input type="password" class="form-control" name="admin_confirm_password">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
