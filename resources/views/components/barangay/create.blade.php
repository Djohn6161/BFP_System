<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addBarangayModal" tabindex="-1" aria-labelledby="addBarangayModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.barangay.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="addBarangayModal">Create Barangay</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Barangay">
                </div>

                <div class="mb-3">
                    <label for="unit" class="form-label">Unit:</label>
                    <input name="unit" type="text" class="form-control" id="unit" placeholder="Enter Unit">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Truck</button>
            </div>
            </form>
            
        </div>
    </div>
</div>
