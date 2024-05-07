<style>

th {
    color: black;
    font-size: 18px;
}

</style>

<div class="modal fade" tabindex="-1" id="viewOperationModal{{ $operation->id }}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder text-primary">AFTER FIRE OPERATION REPORT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">For:</div>
                    {{-- <div class="col-sm-10"><b>{{ $investigation->investigation->for }}</b></div> --}}
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Subject:</div>
                    {{-- <div class="col-sm-10"><b>{{ $investigation->investigation->subject }}</b></div> --}}
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Date:</div>
                    {{-- <div class="col-sm-10"><b>{{ $investigation->investigation->date }}</b></div> --}}
                </div>
                <hr>
                <table class="table table-bordered border-dark table-striped">
                    <h5 class="my-4 fw-bolder">1.</h5> 
                    <tr>
                        <th style="color: black;">Alarm received (Time):</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>Caller/Reported/Transmitted by:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th style="color: black;">Office/Address of the Caller:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>Personnel on duty who receive the alarm:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th style="color: black;">Location:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                </table>
                <br>
                <hr>    

                <table class="table table-bordered border-dark table-striped">
                    <h5 class="my-4 fw-bolder">2.</h5> 
                    <tr>
                        <th style="color: black;">ENGINE DISPATCHED:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>TIME DISPATCHED:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th style="color: black;">TIME ARRIVED AT FIRE SCENE:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>RESPONSE TIME:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th style="color: black;">TIME RETURNED TO BASE:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>WATER TANK REFILLED(GAL):</th>
                        <td class="text-break">DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th style="color: black;">GAS CONSUMED(L):</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                </table>
                <br>
                <hr>
                <table class="table table-bordered border-dark table-striped">
                    <h5 class="my-4 fw-bolder">3.</h5> 
                    <tr>
                        <th style="color: black;">Alarm Status:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>First Responder:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th style="color: black;">Time/Date Under Control:</th>
                        <td class="text-break">DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>time/Date Declared Fire Out:</th>
                        <td class="text-break">DETAILS HERE</td>
                    </tr>
                </table>
                <br>

                <hr> 
                <h5 class="my-4 fw-bolder">4. Type of Occupancy (please specify):</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">5. Approximate Distance of Fire Incident From Fire Station (Km):</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">6. General Description of the structure/s involved:</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>
                
                <hr>
                <br>
                <h5 class="my-4 fw-bolder">7. Total Number of Casualty Reported:</h5>
                 <table class="table table-bordered">
                    <tr>
                      <th> </th>
                      <th>Injured</th>
                      <th>Death</th>
                    </tr>
                    <tr>
                      <th>Civilian</th>
                      <td>DETAILS HERE</td>
                      <td>DETAILS HERE</td>
                    </tr>
                    <tr>
                      <th>FireFighter</th>
                      <td>DETAILS HERE</td>
                      <td>DETAILS HERE</td>
                    </tr>
                  </table>

                <hr>
                <br>
                <h5 class="my-4 fw-bolder">8. Breathing Apparatus Used:</h5>
                 <table class="table table-bordered">
                    <tr>
                      <th>Nr.</th>
                      <th>Type/Kind</th>
            
                    </tr>
                    <tr>
                      <td>DETAILS HERE</td>
                      <td>DETAILS HERE</td>
                    </tr>
                </table>

                <hr>
                <br>
                <h5 class="my-4 fw-bolder">9. Time Alarm Status Declared:</h5>
                 <table class="table table-bordered">
                    <tr>
                      <th>Alarm Status</th>
                      <th>Time</th>
                      <th>Fund Commander</th>
                    </tr>
                    <tr>
                      <td>DETAILS HERE</td>
                      <td>DETAILS HERE</td>
                      <td>DETAILS HERE</td>
                    </tr>
                    <tr>
                      <td>DETAILS HERE</td>
                      <td>DETAILS HERE</td>
                      <td>DETAILS HERE</td>
                    </tr>
                  </table>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">10. Extinguishing Agent Used:</h5>
                   <table class="table table-bordered">
                      <tr>
                        <th>QTY.</th>
                        <th>Type/Kind</th>
              
                      </tr>
                      <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                      </tr>
                  </table>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">11. Rope and Ladder Used:</h5>
                   <table class="table table-bordered">
                      <tr>
                        <th>Type</th>
                        <th>Lenght</th>
              
                      </tr>
                      <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                      </tr>
                  </table>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">12. Hose line Used:</h5>
                   <table class="table table-bordered">
                      <tr>
                        <th>Nr.</th>
                        <th> TYPE/KIND</th>
                        <th>TOTAL ft</th>
                      </tr>
                      <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                      </tr>
                    </table>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">13. Duty Personnel at the Fire Scene:</h5>
                  <table class="table table-bordered border-dark table-striped">
                    <tr>
                        <th style="color: black;">Rank/Name</th></th>
                        <th style="color: black;">Designation</th>
                        <th style="color: black;">Remarks</th>
                      </tr>
                      <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                      </tr>
                    </table>

                <hr>
                <h5 class="my-4 fw-bolder">14. Instruction/Sketch of the Fire Operation (Should Be Attached): 
                    <span class="d-block" style="color: grey; font-style:italic;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Indicate the data frame, legend, location, north arrow and scale)</span>
                </h5>
                <div class="ps-5">
                    Photo Here
                </div>
                <br>
                
                <hr>
                <h5 class="my-4 fw-bolder">15. Details(Narrative)</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>
                
                <hr>
                <h5 class="my-4 fw-bolder">16. Problem/s Rencountered during Operation:</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">17. Observation/Recommendation</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
