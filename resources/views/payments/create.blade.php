@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Payment
    </h2>
    <hr>
    <form method="post" action="{{ route('payments.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="student_id">Student ID<span class="required text-danger">*</span></label>
           <input placeholder="Enter ID"
                value="{{ old('student_id') }}"
                id="student_id"
                required
                name="student_id"
                spellcheck="false"
                class="form-control col-sm-7"
            />
            <div class="input-group-append">
                <button class="btn btn-info">Show Payments</button>
            </div>
        </div>
        <center><h2>Student Name</h2></center><hr>
        <div class="form-group row mx-5">
          <div class="form-check form-check-inline mb-3 mx-3 col admission_fee">
            <input class="form-check-input" type="checkbox" value="Admission Fee" id="admission_fee">
            <label class="form-check-label" for="admission_fee">Admission Fee</label>
          </div>
        </div>
        <div class="form-group row mx-5">
            <div class="form-check form-check-inline mb-3 mx-3 col January">
              <input class="form-check-input" type="checkbox" value="January" id="January">
              <label class="form-check-label" for="January">January</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col February">
              <input class="form-check-input" type="checkbox" value="February" id="February">
              <label class="form-check-label" for="February">February</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col March">
              <input class="form-check-input" type="checkbox" value="March" id="March">
              <label class="form-check-label" for="March">March</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col April">
              <input class="form-check-input" type="checkbox" value="April" id="April">
              <label class="form-check-label" for="April">April</label>
            </div>
        </div>
        <div class="form-group row mx-5">
            <div class="form-check form-check-inline mb-3 mx-3 col May">
              <input class="form-check-input" type="checkbox" value="May" id="May">
              <label class="form-check-label" for="May">May</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col June">
              <input class="form-check-input" type="checkbox" value="June" id="June">
              <label class="form-check-label" for="June">June</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col July">
              <input class="form-check-input" type="checkbox" value="July" id="July">
              <label class="form-check-label" for="July">July</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col August">
              <input class="form-check-input" type="checkbox" value="August" id="August">
              <label class="form-check-label" for="August">August</label>
            </div>
        </div>
        <div class="form-group row mx-5">
            <div class="form-check form-check-inline mb-3 mx-3 col September">
              <input class="form-check-input" type="checkbox" value="September" id="September">
              <label class="form-check-label" for="September">September</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col October">
              <input class="form-check-input" type="checkbox" value="October" id="October">
              <label class="form-check-label" for="October">October</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col November">
              <input class="form-check-input" type="checkbox" value="November" id="November">
              <label class="form-check-label" for="November">November</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col December">
              <input class="form-check-input" type="checkbox" value="December" id="December">
              <label class="form-check-label" for="December">December</label>
            </div>
        </div>
        <div class="form-group row mx-5">
          @foreach($exams as $exam)
            <div class="form-check form-check-inline mb-3 mx-3 col {{ $exam->name_english }}">
              <input class="form-check-input" type="checkbox" value="{{ $exam->name_english }}" id="{{ $exam->name_english }}">
              <label class="form-check-label" for="{{ $exam->name_english }}">{{ $exam->name_english }}</label>
            </div>
          @endforeach
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="previous_due">Previous Due<span class="required text-danger">*</span></label>
            <input value="0"
                id="previous_due"
                name="previous_due"
                spellcheck="false"
                required
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="amount">Payment Amount<span class="required text-danger">*</span></label>
            <input placeholder="Enter Amount"
                value="{{ old('amount') }}"
                id="amount"
                name="amount"
                spellcheck="false"
                required
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="payment_due">Payment Due<span class="required text-danger">*</span></label>
            <input value="0"
                id="payment_due"
                name="payment_due"
                spellcheck="false"
                required
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="date">Payment Date<span class="required text-danger">*</span></label>
            <input placeholder="Enter Date"
                value="{{ Date('Y-m-d') }}"
                type="date"
                id="date"
                name="date"
                spellcheck="false"
                required
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group text-center">
            <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
            <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.description').slideUp(300);
            $('#type').change(function() {
                if(this.value === "Monthly Fee") {
                    $('.monthly').slideDown(300);
                    $('.description').slideUp(300);
                }else {
                    $('.monthly').slideUp(300);
                }
            });
        });
    </script>
@endsection
