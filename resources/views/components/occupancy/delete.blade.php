<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteOccupancyModal{{ $occupancyName->id }}" tabindex="-1" aria-labelledby="deleteOccupancyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.occupancy_name.delete', ['id' =>$occupancyName->id])}}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteOccupancyModal">Delete Occupancy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="occupancyname" class="form-label">Are you sure you want to delete this?</label>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
            </form>
            
        </div>
    </div>
</div>
