<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                @if ($type == 'user')
                    <h1 class="modal-title fs-5" id="addAccountModalLabel">Create User Account</h1>
                @else
                    <h1 class="modal-title fs-5" id="addAccountModalLabel">Create Admin Account</h1>
                @endif

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.account.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="hidden" value="{{$type}}" name="type">
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    @if ($type == 'user')
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="privileges" class="form-label">Privileges:</label>
                                    <select class="form-select" name="privilege" >
                                        <option value="OC">Operation Clerk</option>
                                        <option value="IC">Investigation Clerk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control"placeholder="Confirm Password" name="confirm_password">
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
