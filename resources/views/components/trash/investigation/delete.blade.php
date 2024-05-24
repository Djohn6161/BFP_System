<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteTrashInvestigationModal{{ $investigation->id }}" tabindex="-1"
    aria-labelledby="deleteTrashInvestigationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteTrashInvestigationModalLabel">Are you sure you want to delete this
                    report permanently?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('admin.trash.investigation.delete') }}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" value="{{$investigation->id}}">
                    <div class="mb-3">
                        <h4 class="fw-bolder text-center text-danger">{{$investigation->subject}}</h4>

                        {{-- <p>Are you sure you want to delete this rank?</p> --}}
                        <label for="verifyDelete" class="form-label">Type your password:</label>
                        <input type="password" name="password" class="form-control" id="verifyDelete">

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
