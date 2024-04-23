<style>
    .btn-reports {
        width 200px
    }

    .second-div {
        border: 1px solid #e5e5e5;
        padding: 15px;
        margin-bottom: 20px;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    h3.a {
        text-align: center;
    }
    /* .preview-image {
        max-width: 200px;
        height: auto;
        margin: 10px;
    } */

</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <div class="row">
                    <form>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">MEMORANDUM</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="dateTime" class="form-label">FOR:</label>
                                <input type="text" placeholder="Eg. pedro villa" class="form-control text-uppercase" id="dateTime" required>
                            </div>
 
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="reported" class="form-label">SUBJECT:</label>
                                <input type="text" placeholder="Eg. fire incident report " class="form-control text-uppercase" id="reported" required>

                            </div>
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="province" class="form-label">DATE:</label>
                                <input type="text" placeholder=" Eg. march 02, 2013" class="form-control" id="province" required>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">FINAL INVESTIGATION REPORT (F.I.R)</h3>

                            <div class="col-lg-6 mb-3">
                                <label for="dateTime" class="form-label">INVESTIGATION AND INTELLIGENCE UNIT</label>
                                <input type="text" placeholder="Eg. Purok 5 Paubla, Ligao City" class="form-control" id="dateTime" required>
                            </div>
                            
                            <div class="col-lg-6 mb-3">
                                <label for="dateTime" class="form-label">PLACE OF FIRE</label>
                                <input type="text" placeholder="Eg. Purok 5 Paubla, Ligao City" class="form-control" id="dateTime" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="reported" class="form-label">TIME AND DATE OF ALARM</label>
                                <input type="text" placeholder="Eg. 0034H 30 March 2024" class="form-control" id="reported" required>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="province" class="form-label">ESTABLISHMENT BURNED</label>
                                <input type="text" placeholder=" Eg. Romy Nabas Residence" class="form-control" id="province" required>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="municipality" class="form-label">DAMAGE TO PROPERTY</label>
                                    <input type="text" placeholder=" Eg. Php 20,000.00" class="form-control" id="municipality" required>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="barangay" class="form-label">FIRE VICTIM/S</label>
                                    <input type="text" placeholder=" Eg. Romy nabas" class="form-control" id="barangay" required>
                            </div>
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">ORIGIN OF FIRE</label>
                                <textarea class="form-control" placeholder=" Eg. was at the room located at the right-side portion of the residential structure" name="" id=""></textarea>
                            </div>
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">CAUSE OF FIRE</label>
                                <textarea class="form-control" placeholder="Eg. Electrical Igniton cause by Loose Connection" name="" id=""></textarea>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3"></h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="editor"></div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the input element
    var input = document.getElementById('telephone');

// Listen for input events
input.addEventListener('input', function() {
    // Remove any non-numeric characters
    this.value = this.value.replace(/\D/g, '');

    // Limit the input to exactly 11 digits
    if (this.value.length > 11) {
        this.value = this.value.slice(0, 11);
    }
});
    </script>

<script>
    const quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: 'Compose an epic...',
      
      
    });

    
  </script>
@endsection
