@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Category</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h5 class="card-title mb-0">Category Data</h5> --}}
            <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
          </div>
          <div class="card-body">
              <form action="{{ route('category.update', $data->categoryId) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="text" class="form-control-plaintext" value="{{ $data->categoryId }}" name="categoryId">
                </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" value="{{ $data->categoryName }}" name="categoryName">
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
