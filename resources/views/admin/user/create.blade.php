@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Add User</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}">
              @csrf
                <div class="form-group">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('employeeId') is-invalid @enderror" id="employeeId" name="employeeId" placeholder="Employee Id" value="{{ old('employeeId') }}">
                    <label for="employeeId">Employee Id <span class="text-danger">*</span></label>
                    @error('employeeId') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="name" value="{{ old('name') }}">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    @error('name') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-floating mb-3">
                    <select name="divisionId" id="divisionId" class="form-control">
                    @foreach($data2 as $value)
                        <option value="{{$value->divisionId}}">{{$value->divisionName}}</option>
                    @endforeach
                    </select>
                    <label for="divisionId">Division <span class="text-danger">*</span></label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    @error('email') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-floating mb-3">
                    <input type="tel" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel" placeholder="Phone Number" value="{{ old('tel') }}">
                    <label for="tel">Phone Number <span class="text-danger">*</span></label>
                    @error('tel') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="address" value="{{ old('address') }}">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    @error('address') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-floating mb-3">
                    <select name="role" id="role" class="form-control">
                      <option value="client">Client</option>
                      <option value="admin">Admin</option>
                      <option value="Technician">Technician</option>
                      <option value="manager">Manager</option>
                    </select>
                    <label for="role">Role <span class="text-danger">*</span></label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" value="{{ old('password') }}">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    @error('password') 
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
