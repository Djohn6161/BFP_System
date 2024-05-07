<div class="modal fade" id="deleteModal{{ $investigation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Investigation?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-danger text-center">
                <h4 class="text-danger text-center">
                    <b class="text-danger">
                        {{ $investigation->investigation->subject }}
                    </b>
                    
                </h4>

            </div>
            <div class="modal-footer">
                <form action="{{ route('investigation.'. $type .'.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="id[{{$investigation->id}}]" value="{{ $investigation->id }}">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
