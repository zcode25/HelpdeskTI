@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Category</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <p class="h5 mb-3">Edit Category</p>
            <form action="{{ route('category.update', $data->categoryId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <input type="hidden" class="form-control-plaintext" value="{{ $data->categoryId }}" name="categoryId">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" value="{{ $data->categoryName }}" name="categoryName" id="categoryName">
                <label for="categoryName">Category Name</label>
              </div>
              <div class="form-floating mb-3">
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
