<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editTruckModal{{ $truck->id }}" tabindex="-1" aria-labelledby="editTruckModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.trucks.edit', ['id' => $truck->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTruckModalLabel">Update Truck</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Truck Name:</label>
                        <input type="text" class="form-control" value="{{ $truck->name }}" id="name" name="name" placeholder="Enter Truck Name">
                    </div>
                    <div class="mb-3">
                        <label for="plate_num" class="form-label">Plate Number:</label>
                        <input type="text" class="form-control" value="{{ $truck->plate_num }}" id="plate_num" name="plate_num" placeholder="Enter Plate Number">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        {{-- <input type="text" class="form-select" value="{{ $truck->status }}" id="status" name="status" placeholder="Truck Status"> --}}
                        <select type="text" class="form-select" value="{{ $truck->status }}" id="status" name="status" placeholder="Truck Status">
                            {{-- <option type="text" value="{{ $truck->status }}"selected></option> --}}
                            <option type="text" id="status" name="status" value="active">Active</option>
                            <option type="text" id="status" name="status" value="inactive">Inactive</option>
                        </select>
                        
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
