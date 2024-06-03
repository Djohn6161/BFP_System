<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="ediPasscodeModal{{ $passcode->id }}" tabindex="-1" aria-labelledby="editPasscodeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.passcode.update', ['id' => $passcode->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRankModalLabel">Update Passcode {{$passcode->type}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Type:</label>
                        <select name="type" class="form-control" value="{{$passcode->type}}">
                            <option value="">Select Type</option>
                            <option value="OC"  {{ $passcode->type == 'OC' ? 'selected' : '' }}>Operation Clerk</option>
                            <option value="IC"  {{ $passcode->type == 'IC' ? 'selected' : '' }}>Investigation Clerk</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Action:</label>
                        <select name="action" class="form-control" value="{{$passcode->action}}">
                            <option value="">Select Action</option>
                            <option value="update"  {{ $passcode->action == 'update' ? 'selected' : '' }}>Update</option>
                            <option value="delete"  {{ $passcode->action == 'delete' ? 'selected' : '' }}>Delete</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Current Passcode:</label>
                        <input type="text"  class="form-control" name="passcode" value="{{$passcode->code}}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">New Passcode:</label>
                        <input type="text"  class="form-control" name="new_passcode">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Passcode</button>
                </div>
            </form>            
        </div>
    </div>
</div>
