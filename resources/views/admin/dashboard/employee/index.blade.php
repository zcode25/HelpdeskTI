@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Employee</h1>

    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-xl-6">
            <div class="card">
              <div class="card-body">
              <p class="h5 mb-3">Add Employee</p>
                <form method="POST" action="{{ route('employee.store') }}">
                  @csrf
                  <div class="form-group">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="name" name="name" placeholder="name">
                      <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <select name="divisionId" id="divisionId" class="form-control">
                      @foreach($data2 as $value)
                          <option value="{{$value->divisionId}}">{{$value->divisionName}}</option>
                      @endforeach
                      </select>
                      <label for="divisionId">Division</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="email">
                      <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="tel" class="form-control" id="tel" name="tel" placeholder="tel">
                      <label for="tel">Tel</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="address" name="address" placeholder="address">
                      <label for="address">Address</label>
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
        

        <div class="card">
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
                          <a class="btn btn-primary btn-sm" href="{{ route('employee.edit',$value->employeeId) }}"><i class="align-middle" data-feather="edit"></i></a>
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
