@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Payment
    </h2>
    <hr>
    <form method="post" action="{{ route('payments.store') }}" style="font-size: 16px">
        @csrf
        <div class="input-group row">
            <label class="col-sm-2 col-sm-label text-right" for="student_id">Student ID<span class="required text-danger">*</span></label>
           <input placeholder="Enter ID"
                value="{{ old('student_id') }}"
                id="student_id"
                required
                name="student_id"
                class="form-control col-sm-7"
                aria-label="Enter ID"
                aria-describedby="basic-addon2"
            />
            <div class="input-group-append">
                <a class="btn btn-success" id="search_student" href="#" data-toggle="modal" data-target="#searchModal">Search Student</a>
                <button type="button" class="btn btn-info" id="show_payment">Show Payments</button>
            </div>
        </div>
        <br><hr>
        <div id="payments" style="display: none">
        <center><h2 id="student_name">Student Name</h2></center><hr>
    
        <div class="form-group row mx-5">
          <div class="form-check form-check-inline mb-3 mx-3 col admission_fee">
            <input class="form-check-input" type="checkbox" name="admission" value="Admission Fee" id="admission_fee">
            <label class="form-check-label" for="admission_fee">Admission Fee</label>
          </div>
        </div><hr>
        <div class="form-group row mx-5">
            <div class="form-check form-check-inline mb-3 mx-3 col January">
              <input class="form-check-input" type="checkbox" value="January" id="January" name="months[]">
              <label class="form-check-label" for="January">January</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col February">
              <input class="form-check-input" type="checkbox" value="February" id="February" name="months[]">
              <label class="form-check-label" for="February">February</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col March">
              <input class="form-check-input" type="checkbox" value="March" id="March" name="months[]">
              <label class="form-check-label" for="March">March</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col April">
              <input class="form-check-input" type="checkbox" value="April" id="April" name="months[]">
              <label class="form-check-label" for="April">April</label>
            </div>
        </div>
        <div class="form-group row mx-5">
            <div class="form-check form-check-inline mb-3 mx-3 col May">
              <input class="form-check-input" type="checkbox" value="May" id="May" name="months[]">
              <label class="form-check-label" for="May">May</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col June">
              <input class="form-check-input" type="checkbox" value="June" id="June" name="months[]">
              <label class="form-check-label" for="June">June</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col July">
              <input class="form-check-input" type="checkbox" value="July" id="July" name="months[]">
              <label class="form-check-label" for="July">July</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col August">
              <input class="form-check-input" type="checkbox" value="August" id="August" name="months[]">
              <label class="form-check-label" for="August">August</label>
            </div>
        </div>
        <div class="form-group row mx-5">
            <div class="form-check form-check-inline mb-3 mx-3 col September">
              <input class="form-check-input" type="checkbox" value="September" id="September" name="months[]">
              <label class="form-check-label" for="September">September</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col October">
              <input class="form-check-input" type="checkbox" value="October" id="October" name="months[]">
              <label class="form-check-label" for="October">October</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col November">
              <input class="form-check-input" type="checkbox" value="November" id="November" name="months[]">
              <label class="form-check-label" for="November">November</label>
            </div>
            <div class="form-check form-check-inline mb-3 mx-3 col December">
              <input class="form-check-input" type="checkbox" value="December" id="December" name="months[]">
              <label class="form-check-label" for="December">December</label>
            </div>
        </div><hr>
        <div class="form-group row mx-5">
          @foreach($exams as $exam)
            <div class="form-check form-check-inline mb-3 mx-3 col {{ $exam->name_english }}">
              <input class="form-check-input" type="checkbox" value="{{ $exam->name_english }}" id="{{ $exam->id }}" name="exams[]">
              <label class="form-check-label" for="{{ $exam->id }}">{{ $exam->name_english }}</label>
            </div>
          @endforeach
        </div><hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="previous_due">Previous Due</label>
            <input value="0"
                type="number" 
                id="previous_due"
                name="previous_due"
                spellcheck="false"
                required
                readonly 
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="current_amount">Current Amount</label>
            <input placeholder="Enter Amount"
                type="number" 
                value="0"
                id="current_amount"
                name="current_amount"
                spellcheck="false"
                required
                readonly 
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="total_amount">Total Amount</label>
            <input placeholder="Enter Amount"
                type="number" 
                value="0"
                id="total_amount"
                name="total_amount"
                spellcheck="false"
                required
                readonly 
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="paid_amount">Paid Amount<span class="required text-danger">*</span></label>
            <input placeholder="Enter Amount"
                value="0" 
                id="paid_amount"
                name="paid_amount"
                spellcheck="false"
                required
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="payment_due">Payment Due</label>
            <input value="0"
                type="number" 
                id="payment_due"
                name="payment_due"
                spellcheck="false"
                required
                readonly 
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
      </div>
    </form>

     <!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Search Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="input-group mb-3">

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

                  </div>

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Student's Name</th>
                          <th scope="col">Class</th>
                          <th scope="col">Section</th>
                          <th scope="col">Roll Number</th>
                        </tr>
                      </thead>
                      <tbody id="students">
                      </tbody>
                    </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal-->
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
          var monthlyFee=0;
          var admissionFee=0;
          var examFee=0;
          var exams;
          var currentVal=0;
          var totalVal=0;
          function calculateDue(){
            var paid = $('#paid_amount').val();
            var total = $('#total_amount').val();
            var due = total-paid;
            $('#payment_due').val(due);
          }
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $('#show_payment').click(function() {
            $.ajax({
               type:'GET',
               url:'/getStudent',
               data:{student_id:$('#student_id').val()},
               success:function(student){
                if(student) {
                  document.getElementById('student_name').innerHTML=student.name_english;
                  document.getElementById('previous_due').value=student.due;
                  document.getElementById('payment_due').value=student.due;
                  document.getElementById('total_amount').value=student.due;
                  $('#payments').slideDown(300);
                  //refresh all check boxes
                  var inputs = document.getElementsByTagName('input');
                  for (var i=0; i<inputs.length; i++){
                    if(inputs[i].type == 'checkbox'){
                      inputs[i].disabled = false;
                    }
                  }
                  
                  monthlyFee = student.monthly_fee; 
                  admissionFee = student.admission_fee; 
                  examFee = student.exam_fee; 

                  $.ajax({
                    type: 'GET',
                    url: '/getPayments',
                    data: {student_id:$('#student_id').val()},
                    success: function(payments) {
                      console.log(payments);
                      for(var i=0; i<payments.length; i++) {
                        var payment = payments[i];
                        if(payment.type =="Admission Fee") {
                          console.log("Admission");
                          document.getElementById('admission_fee').disabled=true;
                        }else if(payment.type == "Monthly Fee") {
                          document.getElementById(payment.month).disabled=true;
                        }else if(payment.type == "Exam Fee") {

                          $.ajax({
                            type: 'GET',
                            url: '/getExamId',
                            data: {exam: payment.exam_name},
                            success: function(exam) {
                              console.log(exam.id);
                              document.getElementById(exam.id).disabled=true;
                            }
                          });
                        }
                      }
                    }
                  });
                  calculateDue();
                }else{
                  alert('The Student ID is not valid');
                }
               }
            });
          });
          $.ajax({
            type:'GET',
            url:'/getExams',
            success:function(exam){
                if(exam) {
                  exams = exam;
                }
            }
          }).then(function(){//Click event for exam Fee
            for(var i=0; i<exams.length; i++){
                $('#'+exams[i].id).click(function() {
                  if(this.checked) {
                    currentVal = parseInt($('#current_amount').val());
                    currentVal += parseInt(examFee);
                  }else{
                    currentVal = parseInt($('#current_amount').val());
                    currentVal -= parseInt(examFee);
                  }
                  totalVal = parseInt($('#previous_due').val())+currentVal;
                  $('#current_amount').val(currentVal);
                  $('#total_amount').val(totalVal);
                  calculateDue();
                });
            }
          });
            //click event for admission fee
          $('#admission_fee').click(function() {
            if(this.checked) {
              currentVal = parseInt($('#current_amount').val());
              currentVal += parseInt(admissionFee);
            }else{
              currentVal = parseInt($('#current_amount').val());
              currentVal -= parseInt(admissionFee);
            }
            totalVal = parseInt($('#previous_due').val())+currentVal;
            $('#current_amount').val(currentVal);
            $('#total_amount').val(totalVal);
            calculateDue();
          });

          var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            //click event for monthly fee
          for(var i=0; i<months.length; i++) {
              $('#'+months[i]).click(function() {
                if(this.checked) {
                  currentVal = parseInt($('#current_amount').val());
                  currentVal += parseInt(monthlyFee);
                }else{
                  currentVal = parseInt($('#current_amount').val());
                  currentVal -= parseInt(monthlyFee);
                }
                totalVal = parseInt($('#previous_due').val())+currentVal;
                $('#current_amount').val(currentVal);
                $('#total_amount').val(totalVal);
                calculateDue();
              });
          }


          $('#paid_amount').keyup(function(){
            var paid = $('#paid_amount').val();
            var total = $('#total_amount').val();
            var due = total-paid;
            $('#payment_due').val(due);
          });
          //Ajax call for Student search  modal
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

          $('#roll').keyup(function() {
              $.ajax({
                 type:'GET',
                 url:'/getStudentID',
                 data:{class:$('#class').val(), section:$('#section').val(), roll:$('#roll').val()},
                 success:function(students){
                    var row="";
                    for(var i=0; i<students.length; i++) {
                      row += "<tr>";
                      row += "<td>"+students[i].id+"</td>";
                      row += "<td>"+students[i].name_english+"</td>";
                      row += "<td>"+students[i].class+"</td>";
                      row += "<td>"+students[i].section+"</td>";
                      row += "<td>"+students[i].roll+"</td>";
                      row +="</tr>";
                    }
                    document.getElementById('students').innerHTML=row;
                 }
              });
          });
          $('#section').change(function() {
              $.ajax({
                 type:'GET',
                 url:'/getStudentID',
                 data:{class:$('#class').val(), section:$('#section').val(), roll:$('#roll').val()},
                 success:function(students){
                    var row="";
                    for(var i=0; i<students.length; i++) {
                      row += "<tr>";
                      row += "<td>"+students[i].id+"</td>";
                      row += "<td>"+students[i].name_english+"</td>";
                      row += "<td>"+students[i].class+"</td>";
                      row += "<td>"+students[i].section+"</td>";
                      row += "<td>"+students[i].roll+"</td>";
                      row +="</tr>";
                    }
                    document.getElementById('students').innerHTML=row;
                 }
              });
          });
            
        });
    </script>
@endsection
