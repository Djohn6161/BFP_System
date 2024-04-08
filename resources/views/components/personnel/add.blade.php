<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addPersonnelModal" tabindex="-1"
    aria-labelledby="addPersonnelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPersonnelModalLabel">Add Personnel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPersonnelForm">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="rank" class="form-label">Rank</label>
                        <select class="form-select" id="rank" name="rank" required>
                            <option value="" disabled selected>Select Rank</option>
                            <option value="FO1">Fire Officer 1</option>
                            <option value="FO2">Fire Officer 2</option>
                            <option value="FO3">Fire Officer 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input placeholder="Enter " class="form-control" id="department" name="department" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Personnel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
