@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Employee</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h5 class="card-title mb-0">employee Data</h5> --}}
            <form method="POST" action="{{ route('employee.store') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="name" placeholder="name">
                  </div>
                  <div class="col-sm-2">
                    <select name="divisionId" class="form-control">
                    @foreach($data2 as $value)
                        <option value="{{$value->divisionId}}">{{$value->divisionName}}</option>
                    @endforeach
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="email" class="form-control" name="email" placeholder="email">
                  </div>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="tel" placeholder="tel">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="address" placeholder="address">
                  </div>
                  <div class="col-sm-2">
                        <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                    </div>
                </div>
  
                    
              </form>
          </div>
          <div class="card-body">
          
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Employee Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Division</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tel</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    <td>{{ $value->employeeId }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->division->divisionName }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->tel }}</td>
                    <td>{{ $value->address }}</td>
                    <td>
                        <form action="{{ route('employee.destroy', $value->employeeId) }}" method="POST">
                          <a class="btn btn-primary" href="{{ route('employee.edit',$value->employeeId) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"><i class="align-middle" data-feather="briefcase"></i></button>
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
