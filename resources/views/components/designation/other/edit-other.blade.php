<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editOtherDesignationModal{{$designation->id}}" tabindex="-1" aria-labelledby="editOtherDesignationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.designation.update', ['designation' => $designation->id])}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editOtherDesignationModalLabel">Edit Designation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$designation->name}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
