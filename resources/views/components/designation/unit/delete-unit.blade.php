{{-- <!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteUnitModal{{$designation->id}}" tabindex="-1" aria-labelledby="deleteUnitModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.designation.destroy')}}" enctype="multipart/form-data">
                @csrf
                @method("DELETE")
                <input type="hidden" name="id" id="id" value="{{$designation->id}}">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteUnitModalLabel">Delete Unit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h5 class="text-center">Are you sure you want to delete this designation?</h5>
                        <h4 class="fw-bolder text-center mt-4 text-danger">{{$designation->name}}</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}


<!-- Modal -->
<div  class="modal fade" data-bs-backdrop="static" id="deleteUnitModal{{$designation->id}}" tabindex="-1" aria-labelledby="deleteUnitModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.designation.destroy')}}" enctype="multipart/form-data">
                @csrf
                @method("delete")
                <input type="hidden" name="id" id="id" value="{{$designation->id}}">
                <div class="modal-body text-center p-1">
                    <div class="modal-icon mt-3">
                        <img src="/assets/images/icons/delete.gif" alt="Warning Icon">
                    </div>
                    <h4 class="modal-title" id="deleteOtherDesignationModalLabel">Delete this <strong>"{{$designation->name}}"</strong> designation?</h4>
                    <p>The data associated with this designation will be lost.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>

