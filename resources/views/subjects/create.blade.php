@extends('layouts.template')

@section('content')
<div class="container py-3">
    <h2 class="text-center">
        Add A New Subject
    </h2>
    <hr>
    <form method="post" action="{{ route('subjects.store') }}">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="name">Subject Name<span class="required text-danger">*</span></label>
           <input placeholder="Enter Name"
                value="{{ old('name') }}" 
                id="name"
                required
                name="name"
                spellcheck="false"
                class="form-control col-sm-9"
            />
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="paper">Paper<span class="required text-danger">*</span></label>
            <select id="paper" name="paper" class="form-control col-sm-9">
                <option value="">N/A</option>
                <option>1st Paper</option>
                <option>2nd Paper</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-sm-label text-right" for="code">Subject Code<span class="required text-danger">*</span></label>
           <input placeholder="Enter Code"
                type="number" 
                value="{{ old('code') }}" 
                id="code"
                required
                name="code"
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
        <div class="form-group text-center">
            <input type="reset" class="btn btn-danger mx-4" value="Cancel"/>
            <input type="submit" class="btn btn-primary mx-4" value="Submit"/>
        </div>
    </form>
</div>
@endsection
