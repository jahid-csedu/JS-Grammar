@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-right col-md-5" href="/subjects/create">Add New Subject</a>
                </center>

                <div class="card-body">
                    <table id="subjects" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Subject Name</th>
                          <th scope="col">Paper</th>
                          <th scope="col">Subject Code</th>
                          <th scope="col">Class</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($subjects as $serial=>$subject)
                            <tr>
                              <td>{{ $subject->name }}</td>
                              <td>{{ $subject->paper }}</td>
                              <td>{{ $subject->code }}</td>
                              <td>{{ $subject->class }}</td>
                              <td>
                                <form method="POST" action="{{ route('subjects.destroy', $subject->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info btn-sm" href="{{ route('subjects.edit', $subject) }}">Edit</a>
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
      $('#subjects').DataTable();
    });
</script>
@endsection
