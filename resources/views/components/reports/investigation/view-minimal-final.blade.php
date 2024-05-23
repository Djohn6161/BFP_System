<div class="modal fade" tabindex="-1" id="viewMinimalFinalModal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h3 class="modal-title fw-bolder text-primary">Investigation Subject (MINIMA FINAL)</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body px-4 pb-4 pt-0">
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">For:</div>
                    <div class="col-sm-10"><b>John Doe</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Subject:</div>
                    <div class="col-sm-10"><b>Investigation Subject</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Date:</div>
                    <div class="col-sm-10"><b>May 1, 2024</b></div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="2" class="fw-bolder">DETAILS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Date and Time of Actual Occurence:</td>
                            <td>May 1, 2024, 12:34 PM</td>
                        </tr>
                        <tr>
                            <td>Date and Time reported:</td>
                            <td>May 1, 2024, 12:35 PM</td>
                        </tr>
                        <tr>
                            <td>Incident Location:</td>
                            <td>456 Elm St, Springfield</td>
                        </tr>
                        <tr>
                            <td>Involved Property/ Establishment:</td>
                            <td>Residential House</td>
                        </tr>
                        <tr>
                            <td>Property Data:</td>
                            <td>2 stories, wooden frame</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="2" class="fw-bolder">RESPONSE AND SUPPRESSION DATA</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="1" class="fw-bold">Receiver</td>
                            <td colspan="1" class="fw-bold">Lt. Jane Smith</td>
                        </tr>
                        <tr>
                            <td>Caller Information:</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">Complete Name:</div>
                                    <div class="col-sm">John Doe</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">Address:</div>
                                    <div class="col-sm">123 Main St, Springfield</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">Telephone Number:</div>
                                    <div class="col-sm">555-1234</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Notification Originator:</td>
                            <td>Dispatch Center</td>
                        </tr>
                        <tr>
                            <td>First Responding Unit:</td>
                            <td> <b>Engine 1</b> and Crew, <b>Lt. Jane Smith</b> Team Leader</td>
                        </tr>
                        <tr>
                            <td>Time of Arrival on Scene:</td>
                            <td>12:45 PM</td>
                        </tr>
                        <tr>
                            <td>Alarm Status-Time:</td>
                            <td>First Alarm</td>
                        </tr>
                        <tr>
                            <td>Time Fire Out:</td>
                            <td>2:00 PM</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="2" class="fw-bolder">INVOLVED PARTIES</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Owner of property/establishment:</td>
                            <td>Jane Doe</td>
                        </tr>
                        <tr>
                            <td>Occupant of property/establishment</td>
                            <td>John Doe</td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="my-4 fw-bolder">DETAILS OF INVESTIGATION</h3>
                <div class="ps-5">
                    <p class="text-dark">
                        The fire started in the kitchen and spread quickly to the rest of the house. The cause is suspected to be a grease fire.
                    </p>
                </div>
                <hr>
                <h3 class="my-4 fw-bolder">FINDINGS</h3>
                <div class="ps-5">
                    <p class="text-dark">
                        The fire was contained to the kitchen and dining area. No structural damage to the second floor.
                    </p>
                </div>
                <hr>
                <h3 class="my-4 fw-bolder">RECOMMENDATION</h3>
                <div class="ps-5">
                    <p class="text-dark">
                        Recommend additional training for handling kitchen fires and maintaining equipment readiness.
                    </p>
                </div>
                <hr>
                <h3 class="my-4 fw-bolder">PHOTOGRAPH OF FIRE SCENE</h3>
                <div class="ps-5 row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body p-1">
                                <a href="sample-photo1.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                                    <img style="height: 350px; object-fit: cover;" class="w-100" src="sample-photo1.jpg" alt="Sample Image 1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewFinalModal{{ $investigation->id }}"><span><i class="ti ti-arrow-back"></i></span><span> Go Back</span></button>
                <a href="#" type="button" class="btn btn-warning"> <i class="ti ti-printer"></i> Print</a>
            </div>
        </div>
    </div>
</div>