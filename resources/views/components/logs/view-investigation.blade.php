<div class="modal fade" tabindex="-1" id="viewInvestigationLogs">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h3 class="modal-title fw-bolder text-primary">HAHAHAHA</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div>
                <h5>Date time</h5>
                <p>{{ $log->updated_at }}</p>
            </div>
                <h5>User</h5>
                <p>{{ $log->user->name }}</p>
            </div>
        </div>
    </div>
</div>