 <!-- Modal -->
<div class="modal fade" id="viewPersonnelModal" tabindex="-1" aria-labelledby="viewPersonnelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="viewPersonnelModalLabel">Personal Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-4">
                          <img src="{{ asset('assets/images/logos/tin.jpg') }}" height="300" class="img-fluid" alt="Personnel Picture">
                      </div>
                      <div class="col-md-8">
                          <h4>Department: <span id="departmentPlaceholder">Admin</span></h4>
                          <h4>Rank: <span id="rankPlaceholder">Sergeant</span></h4>
                          <h4>Name: <span id="namePlaceholder">Don John Daryl Curativo</span></h4>
                          <h4>Date of Birth: <span id="dobPlaceholder">January 10, 2000</span></h4>
                          <h4>Gender: <span id="genderPlaceholder">Male</span></h4>
                          <h4>Address: <span id="addressPlaceholder">Santiago Old Nabua, Camarines Sur</span></h4>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
          </div>
      </div>
  </div>
</div>
