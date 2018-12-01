@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h1 class="text-center">
        Add A New Student
    </h1>
    <hr>
    <form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
        @csrf
        <center><h2 class="text-primary">Personal Information</h2></center>
        <hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name_english">Student's Name (English)<span class="required text-danger">*</span></label>
           <input placeholder="Enter Student's Name"
                value="{{ old('name_english') }}"
                id="name_english"
                required
                name="name_english"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name_bangla">বাংলা<span class="required text-danger">*</span></label>
           <input placeholder="ছাত্র/ছাত্রীর নাম"
                value="{{ old('name_bangla') }}"
                id="name_bangla"
                required
                name="name_bangla"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="father_name_english">Father's Name (English)<span class="required text-danger">*</span></label>
           <input placeholder="Enter Father's Name"
                value="{{ old('father_name_english') }}"
                id="father_name_english"
                required
                name="father_name_english"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="father_name_bangla">বাংলা<span class="required text-danger">*</span></label>
           <input placeholder="বাবার নাম"
                value="{{ old('father_name_bangla') }}"
                id="father_name_bangla"
                required
                name="father_name_bangla"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="father_profession">Father's Profession</label>
           <input placeholder="Enter Profession"
                value="{{ old('father_profession') }}"
                id="father_profession"
                name="father_profession"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="father_phone">Father's Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ old('father_phone') }}"
                type="tel"
                id="father_phone"
                name="father_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="mother_name_english">Mother's Name(English)<span class="required text-danger">*</span></label>
           <input placeholder="Enter Mother's Name"
                value="{{ old('mother_name_english') }}"
                id="mother_name_english"
                required
                name="mother_name_english"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="mother_name_bangla">বাংলা<span class="required text-danger">*</span></label>
           <input placeholder="মায়ের নাম"
                value="{{ old('mother_name_bangla') }}"
                id="mother_name_bangla"
                required
                name="mother_name_bangla"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="mother_profession">Mother's Profession</label>
           <input placeholder="Enter Profession"
                value="{{ old('mother_profession') }}"
                id="mother_profession"
                name="mother_profession"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="mother_phone">Mother's Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ old('mother_phone') }}"
                type="phone"
                id="mother_phone"
                name="mother_phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="present_address">Present Address</label>
           <textarea placeholder="Enter Present Address"
                value="{{ old('present_address') }}"
                id="present_address"
                name="present_address"
                rows="4"
                style="resize: vertical;"
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="permanent_address">Permanent Address</label>
           <textarea placeholder="Enter Permanent Address"
                value="{{ old('permanent_address') }}"
                id="permanent_address"
                name="permanent_address"
                rows="4"
                style="resize: vertical;"
                spellcheck="false"
                class="form-control col-sm-9"
                ></textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="dob">Date of Birth</label>
            <input placeholder="mm/dd/yyyy"
                 value="{{ old('dob') }}"
                type="date"
                id="dob"
                name="dob"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="blood_group">Blood Group</label>
            <select id="blood_group" name="blood_group" class="form-control col-sm-9">
                <option value="">N/A</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>O+</option>
                <option>O-</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="photo">Photo</label>
            <input type="file"
                accept=".jpg, .jpeg, .png"
                id="photo"
                name="photo"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <center><h2 class="text-primary">Academic Information</h2></center>
        <hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="academic_year">Academic Year</label>
           <input type="number"
                value="{{ Date('Y') }}"
                id="academic_year"
                name="academic_year"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Class<span class="required text-danger">*</span></label>
            <select id="class" name="class" class="form-control col-sm-9" required>
                @foreach($classes as $class)
                    <option>{{$class->name_english}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="section">Section</label>
            <select id="section" name="section" class="form-control col-sm-9" required>
               <option value="">Section</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="roll">Roll Number</label>
           <input placeholder="Enter Roll Number"
                type="number"
                value="{{ old('roll') }}"
                id="roll"
                name="roll"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="previous_institute">Previous School</label>
           <input placeholder="Enter School Name"
                value="{{ old('previous_institute') }}"
                id="previous_institute"
                name="previous_institute"
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
            $.ajax({
               type:'GET',
               url:'/getSections',
               data:{class:$('#class').val()},
               success:function(data){
                  document.getElementById('section').innerHTML=data;
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
