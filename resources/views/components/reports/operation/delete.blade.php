{{-- <div class="modal fade" id="deleteModal{{ $operation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Operation Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('operation.delete', $operation->id) }}">
                    @csrf
                    @method('PUT')
                    <h4>Are you sure you want to delete this report?</h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div  class="modal fade" id="deleteModal{{ $operation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('operation.delete', $operation->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id" value="{{$operation->id}}">
                <div class="modal-body text-center p-1">
                    <div class="modal-icon mt-3">
                        <img src="/assets/images/icons/delete.gif" alt="Warning Icon">
                    </div>
                    <h5 class="modal-title" id="deleteModalLabel">Delete this operation transmitted by <strong>{{$operation->transmitted_by}}</strong> from <strong>{{$operation->caller_address}}</strong>  at <strong>{{$operation->zone}}, {{$operation->barangay_name}} {{$operation->location}}</strong>  </h5>
                   
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>

