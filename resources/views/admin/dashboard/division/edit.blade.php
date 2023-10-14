@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Division</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
              <p class="h5 mb-3">Edit Division</p>
              <form action="{{ route('division.update', $data->divisionId) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <input type="hidden" class="form-control-plaintext" value="{{ $data->divisionId }}" name="divisionId">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $data->divisionName }}" name="divisionName" id="divisionName">
                    <label for="divisionName">Division Name</label>
                  </div>
                  <div class="form-floating mb-3">
                    <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
