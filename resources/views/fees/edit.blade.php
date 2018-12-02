@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update Fees
    </h2>
    <hr>
    <form method="post" action="{{ route('fees.update', $fee) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Class<span class="required text-danger">*</span></label>
            <select id="class" name="class" class="form-control col-sm-9" required>
                @foreach($classes as $class)
                    @if($class->name_english === $fee->class)
                        <option selected>{{$class->name_english}}</option>
                    @else
                        <option>{{$class->name_english}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="admission_fee">Admission Fee<span class="required text-danger">*</span></label>
           <input placeholder="Enter Admission Fee"
                type="number"
                value="{{ $fee->admission_fee }}" 
                id="admission_fee"
                required
                name="admission_fee"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="monthly_fee">Monthly Fee<span class="required text-danger">*</span></label>
           <input placeholder="Enter Monthly Fee"
                type="number"
                value="{{ $fee->monthly_fee }}" 
                id="monthly_fee"
                required
                name="monthly_fee"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="exam_fee">Examination Fee<span class="required text-danger">*</span></label>
           <input placeholder="Enter Admission Fee"
                type="number"
                value="{{ $fee->exam_fee }}" 
                id="exam_fee"
                required
                name="exam_fee"
                spellcheck="false"
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
