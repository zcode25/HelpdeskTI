@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">User</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
              <p class="h5 mb-3">Edit User</p>
              <form action="{{ route('user.update', $data->userId) }}" method="POST">
              @csrf
              @method('PUT')
                <div class="form-group">
                    <input type="hidden" class="form-control-plaintext" value="{{ $data->userId }}" name="userId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="employeeId" name="employeeId" placeholder="employeeId" value="{{ $data->employeeId }}" readonly>
                        <label for="employeeId">Employee Id</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ $data->employee->name }}" readonly>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="division" name="division" placeholder="division" value="{{ $data->employee->division->divisionName }}" readonly>
                        <label for="division">Division</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="role" id="role" class="form-control">
                        @foreach($data2 as $value)
                            @if ($value['role'] == $data->role)
                                <option value="{{ $value['role'] }}" selected = "selected">{{ $value['role'] }}</option>
                            @else
                                <option value="{{ $value['role'] }}">{{ $value['role'] }}</option>
                            @endif
                        @endforeach
                        </select>
                        <label for="role">Role</label>
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
