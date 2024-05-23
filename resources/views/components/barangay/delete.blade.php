{{-- <!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteBarangayModal{{ $barangay->id }}" tabindex="-1" aria-labelledby="deleteBarangayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.barangay.delete', ['id' => $barangay->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBarangayModalLabel">Delete Truck</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Barangay?</p>
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
<div class="modal fade" data-bs-backdrop="static" id="deleteBarangayModal{{ $barangay->id }}" tabindex="-1" aria-labelledby="deleteBarangayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.barangay.delete', ['id' => $barangay->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-0">
                    <div class="modal-icon mt-3">
                        <img src="/assets/images/icons/delete.gif" alt="Warning Icon">
                    </div>
                    <h4 class="modal-title" id="deleteBarangayModalLabel">Delete this <strong>"{{ $barangay->name }}"</strong> truck?</h4>
                    <p>The data associated with this baramgay will be lost.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>
