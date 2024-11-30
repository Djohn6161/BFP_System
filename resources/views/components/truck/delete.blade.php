<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteTruckModal{{ $truck->id }}" tabindex="-1" aria-labelledby="deleteTruckModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.trucks.delete', ['id' => $truck->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-1">
                    <div class="modal-icon mt-3">
                        <img src="/assets/images/icons/delete.gif" alt="Warning Icon">
                    </div>
                    <h4 class="modal-title"id="deleteTruckModalLabel">Delete this <strong>"{{ $truck->name }}"</strong> truck?</h4>
                    <p>Be <span class="text-danger text-bolder">ALARMED </span> That data associated with this truck will be lost.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>
