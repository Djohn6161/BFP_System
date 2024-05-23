<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteRankModal{{ $rank->id }}" tabindex="-1" aria-labelledby="deleteRankModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.rank.delete', ['id' => $rank->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-0">
                    <div class="modal-icon mt-3">
                        <img src="/assets/images/icons/delete.gif" alt="Warning Icon">
                    </div>
                    <h4 class="modal-title" id="deleteRankModalLabel">Delete this <strong>"{{ $rank->name }}"</strong> rank?</h4>
                    <p>The data associated with this rank will be lost.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>
