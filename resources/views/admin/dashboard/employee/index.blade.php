@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">employee</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h5 class="card-title mb-0">employee Data</h5> --}}
            <form method="POST" action="{{ route('employee.store') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employeeName" placeholder="employeeName">
                  </div>
                  <div class="col-sm-2">
                    <select name="divisionId" class="form-control">
                        <option value="Network">Network</option>
                        <option value="Software">Software</option>
                        <option value="Hardware">Hardware</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" placeholder="employeeName">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="employeeName" placeholder="employeeName">
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
                    <th scope="col">employeeId</th>
                    <th scope="col">employeeName</th>
                    <th scope="col">Division</th>
                    <th scope="col">email</th>
                    <th scope="col">tel</th>
                    <th scope="col">address</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    <td>{{ $value->employeeId }}</td>
                    <td>{{ $value->employeeName }}</td>
                    <td>{{ $value->employeeName }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->tel }}</td>
                    <td>{{ $value->address }}</td>
                    <td>
                        <form action="{{ route('employee.destroy', $value->employeeId) }}" method="POST">
                          <a class="btn btn-primary" href="{{ route('employee.edit',$value->employeeId) }}">Edit</a>
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
