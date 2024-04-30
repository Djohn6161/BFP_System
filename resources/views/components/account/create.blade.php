<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addAccountModalLabel">Create Account</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name">
          </div>
          <div class="row">
            <div class="col">
                <div class="mb-3">
            <label for="type" class="form-label">Type:</label>
            <select class="form-select" id="type">
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
            </div>
            <div class="col">
                <div class="mb-3">
            <label for="privileges" class="form-label">Privileges:</label>
            <select class="form-select" id="privileges">
              <option value="full">Full</option>
              <option value="limited">Limited</option>
            </select>
          </div>
            </div>
            
          
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Create Account</button>
        </div>
      </div>
    </div>
  </div>
  