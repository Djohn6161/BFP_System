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
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name">
                    </div>
                    @if ($type == 'user')
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="privileges" class="form-label">Privileges:</label>
                                    <select class="form-select" name="privilege" id="privilege">
                                        <option value="OC">Operation Clerk</option>
                                        <option value="IC">Investigation Clerk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Current Password:</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Confirm Password"
                            name="confirm_password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#editAccountModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userData = button.data('user');
        var user = JSON.parse(userData);

        // Populate form fields with user data
        $('#name').val(user.name);
        $('#privilege').val(user.privilege);
        $('#email').val(user.email);
        // Populate other form fields as needed
    });
</script>
