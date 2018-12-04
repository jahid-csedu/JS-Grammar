@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Update Student Information
    </h2>
    <hr>
    <form method="post" action="/students/{{ $student->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <center><h2 class="text-primary">Personal Information</h2></center>
        <hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name_english">Student's Name (English)<span class="required text-danger">*</span></label>
           <input placeholder="Enter Student's Name"
                value="{{ $student->name_english }}"
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
                value="{{ $student->name_bangla }}"
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
                value="{{ $student->father_name_english }}"
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
                value="{{ $student->father_name_bangla }}"
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
                value="{{ $student->father_profession }}"
                id="father_profession"
                name="father_profession"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="father_phone">Father's Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ $student->father_phone }}"
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
                value="{{ $student->mother_name_english }}"
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
                value="{{ $student->mother_name_bangla }}"
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
                value="{{ $student->mother_profession }}"
                id="mother_profession"
                name="mother_profession"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="mother_phone">Mother's Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ $student->mother_phone }}"
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
                value="{{ $student->present_address }}"
                id="present_address"
                name="present_address"
                rows="4"
                style="resize: vertical;"
                spellcheck="false"
                class="form-control col-sm-9"
                >{{ $student->present_address }}</textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="permanent_address">Permanent Address</label>
           <textarea placeholder="Enter Permanent Address"
                value="{{ $student->permanent_address }}"
                id="permanent_address"
                name="permanent_address"
                rows="4"
                style="resize: vertical;"
                spellcheck="false"
                class="form-control col-sm-9"
                >{{ $student->permanent_address }}</textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="dob">Date of Birth</label>
            <input placeholder="mm/dd/yyyy"
                 value="{{ $student->dob }}"
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
                @switch($student->blood_group)
                    @case("A+")
                        <option value="">N/A</option>
                        <option selected>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("A-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option selected>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("B+")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option selected>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("B-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option selected>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("AB+")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option selected>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("AB-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option selected>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    @break
                    @case("O+")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option selected>O+</option>
                        <option>O-</option>
                    @break
                    @case("O-")
                        <option value="">N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option selected>O-</option>
                    @break
                    @default
                        <option>N/A</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                @endswitch
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
                value="{{ $student->academic_year }}"
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
                    @if($student->class === $class->name_english)
                        <option selected>{{$class->name_english}}</option>
                    @else
                        <option>{{$class->name_english}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="section">Section</label>
            <select id="section" name="section" class="form-control col-sm-9" required>
                @foreach($sections as $section)
                    @if($section->name_english === $student->section)
                        <option selected>{{$section->name_english}}</option>
                    @else
                        <option>{{$section->name_english}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="roll">Roll Number</label>
           <input placeholder="Enter Roll Number"
                type="number"
                value="{{ $student->roll }}"
                id="roll"
                name="roll"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="institute">Previous Institute</label>
           <input placeholder="Enter School Name"
                value="{{ $student->previous_institute }}"
                id="previous_institute"
                name="previous_institute"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <center><h2 class="text-primary">Fees Information</h2></center>
        <hr>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="admission_fee">Admission Fee</label>
           <input type="number"
                value="{{ $student->admission_fee }}"
                id="admission_fee"
                name="admission_fee"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="monthly_fee">Monthly Fee</label>
           <input type="number"
                value="{{ $student->monthly_fee }}"
                id="monthly_fee"
                name="monthly_fee"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="exam_fee">Examination Fee</label>
           <input type="number"
                value="{{ $student->exam_fee }}"
                id="exam_fee"
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
                $.ajax({
                   type:'GET',
                   url:'/getFees',
                   data:{class:this.value},
                   success:function(data){
                        $('#admission_fee').val(data.admission_fee);
                        $('#monthly_fee').val(data.monthly_fee);
                        $('#exam_fee').val(data.exam_fee);
                   }
                });
            });
        });
    </script>
@endsection
