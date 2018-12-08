@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <div class="card-header">
                  <form method="GET" action="/showResult">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-success" for="exam">Exam Name</label>
                      </div>
                      <select class="custom-select" id="exam" name="exam">
                        @foreach($exams as $exam)
                          <option>{{$exam->name_english}}</option>
                        @endforeach
                      </select>

                      <div class="input-group-prepend">
                        <label class="input-group-text bg-success" for="class">Class</label>
                      </div>
                      <select class="custom-select" id="class" name="class">
                        @foreach($classes as $class)
                          <option>{{$class->name_english}}</option>
                        @endforeach
                      </select>

                      <div class="input-group-prepend">
                        <label class="input-group-text bg-success" for="section">Section</label>
                      </div>
                      <select class="custom-select" id="section" name="section">
                      </select>

                      <div class="input-group-prepend">
                        <label class="input-group-text bg-success" for="roll">Roll</label>
                      </div>
                      <input type="number" class="form-control" id="roll" name="roll">

                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Show Results</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
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
            $.ajax({
               type:'GET',
               url:'/getSections',
               data:{class:$('#class').val()},
               success:function(sections){
                  var options="";
                  for(var i=0; i<sections.length; i++) {
                    options += "<option>"+sections[i].name_english+"</option>";
                  }
                  document.getElementById('section').innerHTML=options;
                  document.getElementById('section').selectedIndex=-1;
               }
            });
            $.ajax({
               type:'GET',
               url:'/getFees',
               data:{class:$('#class').val()},
               success:function(fees){
                    $('#admission_fee').val(fees.admission_fee);
                    $('#monthly_fee').val(fees.monthly_fee);
                    $('#exam_fee').val(fees.exam_fee);
               }
            });
            $('#class').change(function() {
                $.ajax({
                   type:'GET',
                   url:'/getSections',
                   data:{class:this.value},
                   success:function(sections){
                      var options="";
                      for(var i=0; i<sections.length; i++) {
                        options += "<option>"+sections[i].name_english+"</option>";
                      }
                      document.getElementById('section').innerHTML=options;
                      document.getElementById('section').selectedIndex=-1;
                   }
                });
            });
        });
    </script>
@endsection
