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
                    <label for="current_password" class="form-label">Current Password:</label>
                    <div class="input-group show-password mb-3" id="show_hide_password_current">
                        <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter Current Password">
                        <input type="hidden" name="password_id" id="update_password_id">
                        <span class="input-group-text"><a href="#"><i class="ti ti-eye-off" aria-hidden="true"></i></a></span>
                    </div>
            
                    <label for="password" class="form-label">New Password:</label>
                    <div class="input-group show-password mb-3" id="show_hide_password_new">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        <span class="input-group-text"><a href="#"><i class="ti ti-eye-off" aria-hidden="true"></i></a></span>
                    </div>
                    
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <div class="input-group show-password mb-3" id="show_hide_password_confirm">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                        <span class="input-group-text"><a href="#"><i class="ti ti-eye-off" aria-hidden="true"></i></a></span>
                    </div>
                    
                    <label for="admin_confirm_password" class="form-label">Admin Confirmation Password:</label>
                    <div class="input-group show-password mb-3" id="show_hide_password_admin">
                        <input type="password" class="form-control" name="admin_confirm_password" placeholder="Admin Confirm Password">
                        <span class="input-group-text"><a href="#"><i class="ti ti-eye-off" aria-hidden="true"></i></a></span>
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
    $(document).ready(function() {
        $('#updatePasswordModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var accountId = button.data('account-id');

            $('#update_password_id').val(accountId);
        });

        $(".show-password a").on('click', function(event) {
            event.preventDefault();
            var passwordField = $(this).closest('.show-password').find('input[type="password"], input[type="text"]');
            var icon = $(this).find('i');
            
            if (passwordField.attr("type") == "text") {
                passwordField.attr('type', 'password');
                icon.addClass("ti-eye-off");
                icon.removeClass("ti-eye");
            } else if (passwordField.attr("type") == "password") {
                passwordField.attr('type', 'text');
                icon.removeClass("ti-eye-off");
                icon.addClass("ti-eye");
            }
        });
    });
</script>
