<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editBarangayModal{{ $barangay->id }}" tabindex="-1" aria-labelledby="editBarangayModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.barangay.edit', ['id' => $barangay->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editBarangayModalLabel">Update Barangay</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" value="{{ $barangay->name }}" id="name" name="name" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit:</label>
                        <input type="text" class="form-control" value="{{ $barangay->unit }}" id="unit" name="unit" placeholder="Enter Unit">
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Truck</button>
                </div>
            </form>            
        </div>
    </div>
</div>
