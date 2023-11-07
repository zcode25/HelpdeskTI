@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Add Category</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('category.store') }}">
              @csrf
              <div class="form-group">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('categoryName') is-invalid @enderror" name="categoryName" id="categoryName" placeholder="categoryName" value="{{ old('categoryName') }}">
                  <label for="categoryName">Category Name</label>
                  @error('categoryName') 
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
