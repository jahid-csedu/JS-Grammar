@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add a new class
    </h2>
    <hr>
    <form method="post" action="{{ route('classes.update',$class) }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name_english">Class Name(English)<span class="required">*</span></label>
            <input placeholder="Enter Class"
                id="name_english"
                value="{{ $class->name_english }}"
                required
                name="name_english"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name_bangla">শ্রেণির নাম<span class="required">*</span></label>
            <input placeholder="Enter Class"
                id="name_bangla"
                value="{{ $class->name_bangla }}"
                required
                name="name_bangla"
                spellcheck="false"
                class="form-control col-sm-9"
                />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="class">Class(Number)<span class="required text-danger">*</span></label>
           <input placeholder="Enter Class"
                type="number"
                value="{{ $class->class }}"
                id="class"
                required
                name="class"
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
