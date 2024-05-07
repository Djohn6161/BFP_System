<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="updatePasswordModal" tabindex="-1"
    aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                @if ($type == 'user')
                    <h1 class="modal-title fs-5" id="addAccountModalLabel">Update User Account Password</h1>
                @else
                    <h1 class="modal-title fs-5" id="addAccountModalLabel">Update Admin Account Password</h1>
                @endif

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.account.password.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password" class="form-label">Current Password:</label>
                        <input type="hidden" name="password_id" id="password_id">
                        <input type="password" class="form-control" name="current_password"
                            placeholder="Enter Current Password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            name="confirm_password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Admin Confirmation Password:</label>
                        <input type="password" class="form-control"
                            placeholder="Admin Confirm Password"name="admin_confirm_password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Account Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#updatePasswordModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        console.log(id);
        // $('#password_id').val(id);
    });
</script>
