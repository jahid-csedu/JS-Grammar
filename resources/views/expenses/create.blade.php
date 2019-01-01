@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Expenditure Information
    </h2>
    <hr>
    <form method="post" action="{{ route('expenses.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="type">Expense Type<span class="required text-danger">*</span></label>
            <select id="type" name="type" class="form-control col-sm-9" required>
                <option>Salary</option>
                <option>House Rent</option>
                <option>Bill</option>
                <option>Others</option>
            </select>
        </div>
        <div class="form-group input-group row teacherId">
            <label class="col-sm-2 col-sm-label text-right" for="teacher_id">Teacher's ID<span class="required text-danger">*</span></label>
            <input placeholder="Enter ID"
                value="{{ old('teacher_id') }}"
                id="teacher_id"
                name="teacher_id"
                spellcheck="false"
                class="form-control col-sm-8"
                />
            <div class="input-group-append">
                <a class="btn btn-success" id="search_teacher" href="#" data-toggle="modal" data-target="#searchModal">Search Teacher</a>
            </div>
        </div>
        <div class="form-group row monthly">
            <label class="col-sm-2 col-sm-label text-right" for="month">Month</label>
            <select id="month" name="month" class="form-control col-sm-9">
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
        </div>
        <div class="form-group row monthly">
            <label class="col-sm-2 col-sm-label text-right" for="year">Year</label>
            <select id="year" name="year" class="form-control col-sm-9">
                <option>{{ Date('Y') }}</option>
                <option>{{ Date('Y')-1 }}</option>
                <option>{{ Date('Y')+1 }}</option>
            </select>
        </div>
        <div class="form-group row description">
            <label class="col-sm-2 col-sm-label text-right" for="description">Description<span class="required text-danger">*</span></label>
            <textarea placeholder="Enter Description"
                value="{{ old('description') }}"
                id="description"
                name="description"
                rows="3"
                style="resize: vertical;"
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="amount">Amount<span class="required text-danger">*</span></label>
            <input placeholder="Enter Amount"
                value="{{ old('amount') }}"
                id="amount"
                type="number"
                required
                name="amount"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="date">Date</label>
            <input placeholder="Enter Date"
                type="date"
                value="{{ Date('Y-m-d') }}"
                required
                id="date"
                name="date"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group text-center">
            <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
            <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
        </div>
    </form>

     <!-- Modal for Search Teacher ID-->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Search Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                      <label class="input-group-text bg-default" for="teacher_name">Teacher Name</label>
                    </div>
                    <input placeholder="Enter Name" 
                    type="text" 
                    name="teacher_name"
                    id="teacher_name"
                    required
                    class="form-control">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-info" id="search">Search</button>
                    </div>
                </div>

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Teacher's Name</th>
                          <th scope="col">Designation</th>
                        </tr>
                      </thead>
                      <tbody id="teachers">
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
            $('.description').slideUp();
            $('#type').change(function() {
                switch(this.value) {
                    case "Salary":
                        $('.monthly').slideDown(300);
                        $('.teacherId').slideDown(300);
                        $('.description').slideUp(300);
                        break;
                    case "House Rent":
                        $('.monthly').slideDown(300);
                        $('.teacherId').slideUp(300);
                        $('.description').slideUp(300);
                        break;
                    case "Bill":
                        $('.monthly').slideDown(300);
                        $('.teacherId').slideUp(300);
                        $('.description').slideUp(300);
                        break;
                    default:
                        $('.monthly').slideUp(300);
                        $('.teacherId').slideUp(300);
                        $('.description').slideDown(300);
                        break;
                }
            });
            $('#search').click(function() {
                var teacherName = $('#teacher_name').val();
                console.log(teacherName);
                $.ajax({
                    type:'GET',
                    url:'/getTeacherID',
                    data:{name:teacherName},
                    success:function(teachers){
                        var row="";
                        for(var i=0; i<teachers.length; i++) {
                          row += "<tr>";
                          row += "<td>"+teachers[i].id+"</td>";
                          row += "<td>"+teachers[i].name+"</td>";
                          row += "<td>"+teachers[i].designation+"</td>";
                          row +="</tr>";
                        }
                        document.getElementById('teachers').innerHTML=row;
                    }
                });
            });
        });
    </script>
@endsection
