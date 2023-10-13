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
                <div class="form-group row g-3">
                  <input type="hidden" class="form-control-plaintext" value="{{ $data->divisionId }}" name="divisionId">
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $data->divisionName }}" name="divisionName">
                  </div>
                  <div class="col-sm-4">
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
