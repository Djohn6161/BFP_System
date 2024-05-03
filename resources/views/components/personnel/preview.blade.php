<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="filePreviewPersonnelModal" tabindex="-1"
    aria-labelledby="prieviewPersonnelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="filePreviewPersonnelModalLabel">File upload testing preview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ExternalFiles">
                    @foreach ($files as $file)
                        <iframe src="{{ asset('assets/images/personnel_files/' . $file) }}"
                            style="width: 100%; height: 80vh;"></iframe>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
