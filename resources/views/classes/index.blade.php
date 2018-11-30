@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-right col-md-5" href="/classes/create">Add New Class</a>
                </center>

                <div class="card-body">
                    <table id="classes" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Class Name(English)</th>
                          <th scope="col">শ্রেণির নাম</th>
                          <th scope="col">Class(Number)</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($classes as $serial=>$class)
                            <tr>
                              <td>{{ $class->name_english }}</td>
                              <td>{{ $class->name_bangla }}</td>
                              <td>{{ $class->class }}</td>
                              <td>
                                <form method="POST" action="{{ route('classes.destroy', $class->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info btn-sm" href="{{ route('classes.edit', $class->id) }}">Edit</a>
                                  <button type="submit" class="btn btn-danger btn-sm mx-3">Delete</button>
                                </form>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
      $.noConflict();
      $('#classes').DataTable();
    });
</script>
@endsection
