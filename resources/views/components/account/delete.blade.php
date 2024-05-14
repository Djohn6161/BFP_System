<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteAccountModal" tabindex="-1"
    aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteAccountModalLabel">Delete Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.account.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <h3>Are you sure you want to delete this account?</h3>
                    <input type="hidden" name="account_id" id="delete_account_id">
                    <div class="mb-3">
                        <label for="password" class="form-label">Admin Confirmation Password:</label>
                        <input type="password" class="form-control" placeholder="Admin Confirm Password" name="admin_confirm_password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#deleteAccountModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var accountId = button.data('account-id');

            $('#delete_account_id').val(accountId);
        });
    });
</script>
