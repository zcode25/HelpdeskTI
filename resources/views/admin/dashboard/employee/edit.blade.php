@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">employee</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h5 class="card-title mb-0">employee Data</h5> --}}
            <a href="{{ route('employee.create') }}" class="btn btn-primary">Create</a>
          </div>
          <div class="card-body">
              <form action="{{ route('employee.update', $data->employeeId) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="text" class="form-control-plaintext" value="{{ $data->employeeId }}" name="employeeId">
                </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="{{ $data->employeeName }}" name="employeeName">
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                    </div>
              </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
