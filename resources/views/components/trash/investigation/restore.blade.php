<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="restoreTrashInvestigationModal{{ $investigation->id }}" tabindex="-1"
    aria-labelledby="restoreTrashInvestigationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="restoreTrashInvestigationModalLabel">Are you sure about that?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6>Are you sure you want to restore this subject: HAHAHAHA</h6>


                </div>
                <div class="modal-footer">
                    <form method="POST"
                        action="{{ route('admin.trash.investigation.restore', ['id' => $investigation->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
