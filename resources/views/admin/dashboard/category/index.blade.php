@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Category</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Category Data</h5>
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="categoryName" placeholder="categoryName">
                  </div>
                  <div class="col-sm-6">
                        <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                    </div>
                </div>
  
                    
              </form>
          </div>
          <div class="card-body">
          
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">categoryId</th>
                    <th scope="col">cateogryName</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    <td>{{ $value->categoryId }}</td>
                    <td>{{ $value->categoryName }}</td>
                    <td>
                        <form action="{{ route('category.destroy', $value->categoryId) }}" method="POST">
                          <a class="btn btn-primary" href="{{ route('category.edit',$value->categoryId) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
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
