@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Division</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <p class="h5 mb-3">Add Division</p>
            <form method="POST" action="{{ route('division.store') }}">
              @csrf
              <div class="form-group">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="divisionName" id="divisionName" placeholder="Division Name">
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
