<!-- Update Operation  -->
<div class="modal fade" data-bs-backdrop="static" id="updateModal{{ $report->id }}" tabindex="-1"
    aria-labelledby="updateModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{ $report->id }}">Update Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- {{dd($report)}} --}}
                    <h1>New {{ $category }}</h1>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="name{{$report->id}}">Name</label>
                            <input type="text" {{ $report != null ? '' : '' }} placeholder="Enter Incident Name"
                                class="form-control " id="name{{$report->id}}" name="name"
                                value="{{ old('name') ?? ($report->name ?? '') }}">
                            @error('name')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="type{{$report->id}}">Type of Incident</label>

                            <input type="text" placeholder="Enter Incident Name" class="form-control " id="type{{$report->id}}"
                                name="type" value="{{ old('type') ?? ($report->type ?? '') }}">
                            @error('type')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-check ps-3">
                            <label class="form-label" for="exampleCheck1">Time of Departure</label>
                            <input name="time_of_departure" {{ $report != null ? '' : '' }} type="datetime-local"
                                class="form-control " id="exampleCheck1"
                                value="{{ old('time_of_departure') ?? ($report->time_of_departure ?? '') }}">
                            @error('time_of_departure')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-lg-6 mb-3 form-check">
                            <label class="form-label" for="exampleCheck1">Time of Arrival to Scene</label>
                            <input name="time_of_arrival_to_scene" {{ $report != null ? '' : '' }}
                                value="{{ old('time_of_arrival_to_scene') ?? ($report->time_of_arrival_to_scene ?? '') }}"
                                type="datetime-local" class="form-control " id="exampleCheck1">
                            @error('time_of_arrival_to_scene')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteModal{{ $report->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this report?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yes</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger"
                    data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
