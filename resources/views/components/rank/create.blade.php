<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addRankModal" tabindex="-1" aria-labelledby="addRankModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.rank.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRankModalLabel">Create Rank</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug:</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Enter Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Rank</button>
                </div>
            </form>
        </div>
    </div>
</div>
