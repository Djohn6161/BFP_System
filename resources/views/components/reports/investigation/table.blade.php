<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4 text-capitalize">{{$active != 'investigation' ? $active : 'All' }} Investigation  Reports</h5>
            <div class="table-responsive">
                <table class="table mb-0 align-middle w-100">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0" style="max-width:10%">
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
                        @foreach ($investigations as $investigation)
                            <x-reports.view-modal :report=$investigation></x-reports.view-modal>
                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $investigation->for }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ $investigation->subject }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($investigation->date)->format('F j, Y') }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="{{route('operation.edit.form', $investigation->id)}}" class="btn btn-success w-100 mb-1">Update</a>
                                    <br>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $investigation->id }}"
                                        class="btn btn-danger hide-menu w-100 mb-1">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>