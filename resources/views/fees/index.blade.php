@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-sm-auto py-3">
            <div class="card">
                <center class="card-header justify-content-center">
                    <a class="btn btn-success mx-2 pull-right col-md-5" href="/fees/create">Add New Fees</a>
                </center>

                <div class="card-body">
                    <table id="fees" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Class</th>
                          <th scope="col">Admission Fee</th>
                          <th scope="col">Monthly Fee</th>
                          <th scope="col">Examination Fee</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($fees as $serial=>$fee)
                            <tr>
                              <td>{{ $fee->class }}</td>
                              <td>{{ $fee->admission_fee }}</td>
                              <td>{{ $fee->monthly_fee }}</td>
                              <td>{{ $fee->exam_fee }}</td>
                              <td>
                                <form method="POST" action="{{ route('fees.destroy', $fee->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-info btn-sm" href="{{ route('fees.edit', $fee) }}">Edit</a>
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
      $('#fees').DataTable();
    });
</script>
@endsection
