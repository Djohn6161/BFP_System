    <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
        <h3 class="border-bottom border-4 border-warning pb-2 mb-3">MEMORANDUM</h3>
        <div class="col-lg-12 mb-12 pb-2 mb-3">
            <label for="case_number" class="form-label">Case Number:</label>
            <input type="text" placeholder="Eg. pedro villa" id="case_number" name="case_number"
                class="form-control {{ $errors->has('case_number') != '' ? 'is-invalid' : '' }}"
                value="{{ old('case_number') ?? ($spot->investigation->case_number ?? "INV" . now()->year . "_") }}" required>
            @error('case_number')
                <span class="text-danger alert" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-12 mb-12 pb-2 mb-3">
            <label for="for" class="form-label">FOR:</label>
            <input type="text" placeholder="Eg. pedro villa" id="for" name="for"
                class="form-control {{ $errors->has('for') != '' ? 'is-invalid' : '' }}"
                value="{{ old('for') ?? ($spot->investigation->for ?? "") }}" required>
            @error('for')
                <span class="text-danger alert" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-lg-12 mb-12 pb-2 mb-3">
            <label for="subject" class="form-label">SUBJECT:</label>
            <input type="text" placeholder="Eg. fire incident report " id="subject" name="subject"
                class="form-control {{ $errors->has('subject') != '' ? 'is-invalid' : '' }}"
                value="{{ old('subject') ?? ($spot->investigation->subject ?? "")}}" required>
            @error('subject')
                <span class="text-danger alert" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-12 mb-12 pb-2 mb-3">
            <label for="date" class="form-label">DATE:</label>
            <input type="date" placeholder=" Eg. march 02, 2013" id="date" name="date"
                class="form-control {{ $errors->has('date') != '' ? 'is-invalid' : '' }}"
                value="{{ old('date') ?? ($spot->investigation->date ?? Illuminate\Support\Carbon::now()->format('Y-m-d')) }}" required>
            @error('date')
                <span class="text-danger alert" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>