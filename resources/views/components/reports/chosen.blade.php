
            
            <!-- Add Modal -->
            <div class="modal fade" data-bs-backdrop="static" id="addResponseModal" tabindex="-1"
                aria-labelledby="addResponseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <h5 class="modal-title" id="addResponseModalLabel">Modal title</h5> --}}
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Input fields for adding content -->
                            <div class="mb-3 text-center">
                                <h3>You want to use existing report?</h3>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn btn-secondary btn-reports" id="yesBtn">Yes</button>
                            <button type="button" class="btn btn-danger btn-reports" id="noBtn">No</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Modal (No Modal) -->
            <div class="modal fade" id="noModal" tabindex="-1" aria-labelledby="noModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="noModalLabel">Choose which type of incident:</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <a href="{{route('report.create', ['id' => 0, 'type' => 'Fire Incident'])}}" class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Fire Incident</a>
                            <a href="{{route('report.create', ['id' => 0, 'type' => 'Vehicular Accident'])}}" class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Vehicular Accident</a>
                            <a href="{{route('report.create', ['id' => 0, 'type' => 'Non-Emergency Response'])}}" class="btn btn-lg btn-outline-primary d-block w-100">Non-Emergency Response</a>
                        </div>
                    </div>
                </div>
            </div>