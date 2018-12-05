@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Teacher
    </h2>
    <hr>
    <form method="post" action="{{ route('teachers.update', $teacher) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="s_name">Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Teacher's Name"
                value="{{ $teacher->name }}" 
                id="name"
                required
                name="name"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="pres_address">Present Address<span class="required text-danger">*</span></label>
           <textarea placeholder="Enter Present Address"
                id="present_address"
                name="present_address"
                rows="4"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                >{{ $teacher->present_address }}</textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="perm_address">Permanent Address<span class="required text-danger">*</span></label>
           <textarea placeholder="Enter Permanent Address"
                id="permanent_address"
                name="permanent_address"
                rows="4"
                style="resize: vertical;" 
                spellcheck="false"
                class="form-control col-sm-9"
                >{{ $teacher->permanent_address }}</textarea>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="s_phone">Phone Number</label>
           <input placeholder="Enter Phone Number"
                value="{{ $teacher->phone }}" 
                type="phone" 
                id="phone"
                name="phone"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="s_name">Designation<span class="required text-danger">*</span></label>
           <input placeholder="Enter Designation"
                value="{{ $teacher->designation }}" 
                id="designation"
                required
                name="designation"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="dob">Date of Birth</label>
            <input placeholder="mm/dd/yyyy"
                value="{{ $teacher->dob }}" 
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
                @switch($teacher->blood_group)
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
                        <option value="">N/A</option>
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
        <div class="form-group text-center">
            <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
            <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
        </div>
    </form>
</div>
@endsection
