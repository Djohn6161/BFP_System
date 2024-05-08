<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteSectionModal{{$section->id}}" tabindex="-1" aria-labelledby="deleteSectionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.designation.destroy')}}" enctype="multipart/form-data">
                @csrf
                @method("DELETE")
                <input type="hidden" name="id" id="id" value="{{$section->id}}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteSectionModalLabel">Delete Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h3>Are you sure you want to delete this Section, <b class="fw-bolder text-danger"> including all Designation under it</b>?</h3>
                        <h4 class="fw-bolder text-center text-danger">{{$section->name}}</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
