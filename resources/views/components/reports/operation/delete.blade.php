<div class="modal fade" id="deleteModal{{ $operation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Operation Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('operation.delete', $operation->id) }}">
                    @csrf
                    @method('PUT')
                    <h4>Are you sure you want to delete this report?</h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
