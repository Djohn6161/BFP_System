{{-- <div class="modal fade" id="deleteModal{{ $investigation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
</div> --}}

<div  class="modal fade" id="deleteModal{{ $investigation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-1">
            <form action="{{ route('investigation.'. $type .'.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="id[{{$investigation->id}}]" value="{{ $investigation->id }}">
                <div class="modal-body text-center p-0">
                    <div class="modal-icon mt-3">
                        <img src="/assets/images/icons/delete.gif" alt="Warning Icon">
                    </div>
                    @if (auth()->user()->privilege == 'investigation_clerk')
                    <div class="mb-3">
                        {{-- <label for="passcode" class="form-label">Passcode:</label> --}}
                        <input type="hidden" name="passcode_id" id="passcode_id">
                        <input type="passcode" class="form-control" name="passcode"
                            placeholder="Enter your Passcode">
                    </div>
                    @endif
                    <h5 class="modal-title" id="deleteModalLabel">Delete this investigation <strong>{{ $investigation->investigation->subject }} </strong></h5>
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>