<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addTruckModal" tabindex="-1" aria-labelledby="addTruckModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.trucks.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="addOccupancyModal">Create Truck</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Truck Name:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Truck Name">
                </div>

                <div class="mb-3">
                    <label for="plate_num" class="form-label">Plate Number:</label>
                    <input name="plate_num" type="text" class="form-control" id="plate_num" placeholder="Enter Plate Number">
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-select" aria-label="truckStatus">
                        <option selected>Select status</option>
                        <option value="active">active</option>
                        <option value="inactive">Inactive</option>
                    </select>
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
