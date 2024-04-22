    <div class="modal fade" id="chooseInvestigation" tabindex="-1" aria-labelledby="noModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="noModalLabel">Choose chuchuchu</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="#" class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Minimal</a>
                    <a href="#" class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Spot</a>
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2" onclick="progress(this)">Progress</button>
                    <button type="button" class="btn btn-lg btn-outline-primary d-block w-100 mb-2" onclick="progress(this)">Final</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Modal (Yes Modal) -->
<div class="modal fade" id="spotTable" tabindex="-1" aria-labelledby="yesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3 text-center">
                <h3 class="mb-2">Spot Reports</h3>
                <div class="shadow rounded p-4">
                    <table class="table w-100 " id="spotJTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">For</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Subject</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">1</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 text-capitalize">
                                            Name
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">1</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-capitalize">
                                            1hfhfnghchfc
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-capitalize">
                                            1hfhfnghchfc
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="#" class="btn btn-primary w-100 mb-1">apply</a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
