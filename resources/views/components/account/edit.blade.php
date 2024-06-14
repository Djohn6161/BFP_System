<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="editAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                @if ($type == 'user')
                    <h1 class="modal-title fs-5" id="addAccountModalLabel">Edit User Account</h1>
                @else
                    <h1 class="modal-title fs-5" id="addAccountModalLabel">Edit Admin Account</h1>
                @endif

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.account.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="hidden" value="{{ $type }}" name="type">
                        <input type="hidden" name="user_id" id="edit_user_id">
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Enter Name" >
                    </div>
                    @if ($type == 'user')
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="privileges" class="form-label">Privileges:</label>
                                    <select class="form-select" name="privilege" id="edit_privilege">
                                        <option value="admin_clerk">Admin Clerk</option>
                                        <option value="operation_clerk">Operation Clerk</option>
                                        <option value="investigation_clerk">Investigation Clerk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="edit_username" name="username"
                            placeholder="Enter Username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Admin Confirmation Password:</label>
                        <input type="password" class="form-control" id="edit_admin_confirmation_password"
                            placeholder="Confirm Password"name="admin_confirm_password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#editAccountModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var user = button.data('user');
        var type = button.data('type');

        $('#edit_name').val(user.name);
        $('#edit_user_id').val(user.id);
        $('#edit_username').val(user.username);
        if (type == 'user') {
            $('#edit_privilege').val(user.privilege);
        }

    });
</script>
