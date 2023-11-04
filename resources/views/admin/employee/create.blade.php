@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Employee</h1>

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
                <hr>
                <p class="h5 mb-3">Create Account</p>
                <div class="form-floating mb-3">
                    <select name="role" id="role" class="form-control">
                      <option value="client">Client</option>
                      <option value="admin">Admin</option>
                      <option value="Technician">Technician</option>
                      <option value="manager">Manager</option>
                    </select>
                    <label for="role">Role</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    <label for="password">Password</label>
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
