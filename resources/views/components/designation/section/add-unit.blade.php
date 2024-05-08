<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addUnitModal{{$section->id}}" tabindex="-1" aria-labelledby="addUnitModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.designation.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUnitModalLabel">Create Designation in <b>{{$section->name}}</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name">
                            <input type="hidden" name="class" id="class" value="C">
                            <input type="hidden" name="section" id="section" value="{{$section->id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Designation</button>
                </div>
            </form>
        </div>
    </div>
</div>
