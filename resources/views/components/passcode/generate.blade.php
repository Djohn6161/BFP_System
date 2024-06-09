<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="generatePasscodeModal" tabindex="-1"
    aria-labelledby="generatePasscodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.passcode.generate') }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRankModalLabel">Generate Passcode</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Passcode For:</label>
                        <select name="for" class="form-control" id="userschoice" style="width: 100%">
                            <option>Choose User</option>
                            @unless (count($users) == 0)
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @endunless
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate Passcode</button>
                </div>
            </form>
        </div>
    </div>
</div>
