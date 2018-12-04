@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update Exam
    </h2>
    <hr>
    <form method="post" action="{{ route('exams.update', $exam) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name_english">Exam Name(English)<span class="required text-danger">*</span></label>
           <input placeholder="Enter Exam Name"
                value="{{ $exam->name_english }}" 
                id="name_english"
                required
                name="name_english"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name_bangla">বাংলা<span class="required text-danger">*</span></label>
           <input placeholder="পরীক্ষার নাম"
                value="{{ $exam->name_bangla }}" 
                id="name_bangla"
                required
                name="name_bangla"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="weight">Percentile Weight</label>
            <input placeholder="Enter weight"
                value="{{ $exam->weight }}" 
                type="number" 
                id="weight"
                name="weight"
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
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $('#class').change(function() {
                $.ajax({
                   type:'GET',
                   url:'/getSections',
                   data:{class:this.value},
                   success:function(data){
                      document.getElementById('section').innerHTML=data;
                   }
                });
            });
        });
    </script>
@endsection
