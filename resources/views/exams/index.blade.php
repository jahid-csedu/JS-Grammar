@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-left col-md-5" href="exams/create">Add A New Exam</a>
                </center>

                <div class="card-body">
                    <table id="exams" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Exam Name</th>
                          <th scope="col">পরীক্ষার নাম</th>
                          <th scope="col">Percentile Weight</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($exams as $serial=>$exam)
                            <tr>
                              <td>{{ $exam->name_english }}</td>
                              <td>{{ $exam->name_bangla }}</td>
                              <td>{{ $exam->weight }}</td>
                              <td>
                                <form method="POST" action="{{ route('exams.destroy', $exam->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info btn-sm" href="{{ route('exams.edit', $exam->id) }}">Edit</a>
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
      $('#exams').DataTable();
    });
</script>
@endsection
