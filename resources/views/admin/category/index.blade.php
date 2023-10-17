@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Category</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <p class="h5 mb-3">Add Category</p>
            <form method="POST" action="{{ route('category.store') }}">
              @csrf
              <div class="form-group">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="categoryName" name="categoryName" placeholder="categoryName">
                  <label for="categoryName">Category Name</label>
                </div>
                <div class="form-floating mb-3">
                  <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                </div>
              </div>
              </form>
          </div>
        </div>

        <div class="card">
          <div class="card-body">   
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Category Id</th>
                    <th scope="col">Cateogry Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    <td>{{ $value->categoryId }}</td>
                    <td>{{ $value->categoryName }}</td>
                    <td>
                        <form action="{{ route('category.destroy', $value->categoryId) }}" method="POST">
                          <a class="btn btn-primary btn-sm" href="{{ route('category.edit',$value->categoryId) }}"><i class="align-middle" data-feather="edit"></i></a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm"><i class="align-middle" data-feather="trash"></i></button>
                        </form>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            {{-- <h5 class="card-title mb-0">Empty card</h5> --}}

          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
