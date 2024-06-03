{{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Personnel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this personnel?</p>
                <form action="{{ route('admin.personnel.delete', $personnel) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <label for="" class="form-label">Admin Password Confirmation</label>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.personnel.delete', $personnel->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-1">
                    <div class="modal-icon mt-3">
                        <img src="/assets/images/icons/delete.gif" alt="Warning Icon">
                    </div>
                  
                        <h4 class="modal-title" id="deleteModalLabel">Delete <strong>"{{ $personnel->rank->slug . " " . $personnel->first_name . " " . $personnel->last_name }}"</strong> information?</h4>
                  

                    <p>The data associated with this personnel will be lost.</p>
                    <div class="row">
                        <label for="" class="form-label">Admin Password Confirmation</label>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8 mx-auto">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>
