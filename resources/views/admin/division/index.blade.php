@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Division List</h1>
    @if (session()->has('success'))  
    <div class="alert alert-warning alert-dismissible fade show badge bg-success mb-3" role="alert">
      <span>{{ session('success') }}</span>
      <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session()->has('error'))  
    <div class="alert alert-warning alert-dismissible fade show badge bg-danger mb-3" role="alert">
      <span>{{ session('error') }}</span>
      <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <a href="{{ route('division.create') }}" class="btn btn-primary btn-sm mb-4"><i class="align-middle me-2" data-feather="briefcase"></i><span class="align-middle"> Add Division</span></a>
            <table class="table" id="myTable">
                <thead>
                  <tr>
                    {{-- <th scope="col">Division Id</th> --}}
                    <th scope="col">Division Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    {{-- <td>{{ $value->divisionId }}</td> --}}
                    <td>{{ $value->divisionName }}</td>
                    <td>
                        <form action="{{ route('division.destroy', $value->divisionId) }}" method="POST">
                          <a class="btn btn-primary btn-sm" href="{{ route('division.edit',$value->divisionId) }}" title="Edit"><i class="align-middle" data-feather="edit"></i></a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete"><i class="align-middle" data-feather="trash"></i></button>
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
