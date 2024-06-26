<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editOccupancyModal" tabindex="-1" aria-labelledby="editOccupancyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.occupancy_name.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="editOccupancyModal">Edit Occupancy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="occupancyname" class="form-label">Occupancy Name:</label>
                    <input name="name" type="text" class="form-control" value="{{$occupancy_names->name}}" id="occupancyname" placeholder="Enter Occupancy Name">
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
            </form>
            
        </div>
    </div>
</div>
