@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Add Division</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('division.store') }}">
              @csrf
              <div class="form-group">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('divisionName') is-invalid @enderror" name="divisionName" id="divisionName" value="{{ old('divisionName') }}" placeholder="Division Name">
                  <label for="divisionName">Division Name <span class="text-danger">*</span></label>
                  @error('divisionName') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
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
