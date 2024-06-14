<div class="modal fade" id="passUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-1">
            {{-- <input type="hidden" name="id" id="id[{{ $investigation->id }}]" value="{{ $investigation->id }}"> --}}
            <div class="modal-bodyp-0">
                <div class="mb-3 px-4 pt-4">
                        <h5 class="modal-title" id="deleteModalLabel">Enter a valid Passcode:</h5>
                        {{-- <label for="passcode" class="form-label">Passcode:</label> --}}
                        {{-- <input type="hidden" name="passcode_id" id="passcode_id"> --}}
                        <input type="passcode" class="form-control" name="passcode" placeholder="Enter your Passcode">
                    </div>

            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
