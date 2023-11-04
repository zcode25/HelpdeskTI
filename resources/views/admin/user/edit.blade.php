@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Detail User</h1>
    @if (session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show badge bg-success mb-3" role="alert">
      <span>{{ session('success') }}</span>
      <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-warning alert-dismissible fade show badge bg-danger mb-3" role="alert">
      <span>{{ session('success') }}</span>
      <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
              <p class="h5 mb-3">Employee</p>
              <form action="{{ route('user.update', $data->userId) }}" method="POST">
              @csrf
              @method('PUT')
                <div class="form-group">
                    <input type="hidden" class="form-control-plaintext" value="{{ $data->userId }}" name="userId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ $data->employee->name }}">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ $data->employee->email }}" readonly>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="tel" name="tel" placeholder="phone number" value="{{ $data->employee->tel }}">
                        <label for="tel">Phone Number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address" name="address" placeholder="address" value="{{ $data->employee->address }}">
                        <label for="address">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="divisionId" id="divisionId" class="form-control">
                            @foreach($data2 as $value)
                                @if ($value['divisionName'] == $data->division)
                                    <option value="{{ $value['divisionId'] }}" selected = "selected">{{ $value['divisionName'] }}</option>
                                @else
                                    <option value="{{ $value['divisionId'] }}">{{ $value['divisionName'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="divisionId">Division</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="role" name="role" placeholder="role" value="{{ $data->role }}" readonly>
                        <label for="role">Role</label>
                    </div>

                    <div class="form-floating mb-3">
                        <button type="submit" class="col-sm-12 btn btn-primary">Save</button>
                    </div>

                </div>
              </form>
              <div class="form-floating mb-3">
                <form action="{{ route('user.reset', $data->userId) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="col-sm-12 btn btn-danger">Reset Password</button>
                </form>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</main>
@endsection
