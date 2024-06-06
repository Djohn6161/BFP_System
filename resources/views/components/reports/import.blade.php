<!-- Export Investigation Modal -->
<div class="modal fade" id="importInvestigation" tabindex="-1" aria-labelledby="exportInvestigationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exportInvestigationModalLabel">Import Investigation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('investigation.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="selectInvestigation" class="form-label">Type:</label>
                        <select class="form-select" name="Type" id="selectInvestigation">
                            <option selected>Choose investigation type</option>
                            {{-- <option value="All">All</option> --}}
                            <option value="Minimal">Minimal</option>
                            <option value="Spot">Spot</option>
                            <option value="Progress">Progress</option>
                            <option value="Final">Final</option>
                        </select>
                    </div>
                    <label for="export" class="form-label">Import Excel:</label>
                    <div class="d-flex align-items-center">
                        <div class="me-2 w-100">
                            {{-- <label for="exportFrom" class="form-label">From</label> --}}
                            <input type="file" class="form-control" name="file" accept=".csv, .xlsx">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Export Operation Modal -->
<div class="modal fade" id="importOperation" tabindex="-1" aria-labelledby="exportOperationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{  route('operation.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exportOperationModalLabel">Export Operation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="export" class="form-label">Import Excel:</label>
                    <div class="d-flex align-items-center">
                        <div class="me-2 w-100">
                            {{-- <label for="exportFrom" class="form-label">From</label> --}}
                            <input type="file" class="form-control" name="file">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
