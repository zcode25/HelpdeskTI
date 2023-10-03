@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Division</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h5 class="card-title mb-0">Division Data</h5> --}}
            <a href="{{ route('division.create') }}" class="btn btn-primary">Create</a>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('division.update', $data->divisionId) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" class="form-control-plaintext" value="{{ $data->divisionId }}" name="divisionId">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="{{ $data->divisionName }}" name="divisionName">
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                    </div>
              </form>
              {{-- <form action="{{ route('division.update', $data->divisionId) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="divisionId" id="">
              </form> --}}
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
