@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Employee</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
              <p class="h5 mb-3">Edit Employee</p>
              <form action="{{ route('employee.update', $data->employeeId) }}" method="POST">
              @csrf
              @method('PUT')
                <div class="form-group">
                    <input type="hidden" class="form-control-plaintext" value="{{ $data->employeeId }}" name="employeeId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $data->name }}" name="name" id="name">
                        <label for="name">Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="divisionId" id="divisionId" class="form-control">
                        @foreach($data2 as $value)
                            @if ($value->divisionId == $data->division->divisionId)
                                <option value="{{ $value->divisionId }}" selected = "selected">{{ $value->divisionName }}</option>
                            @else
                                <option value="{{ $value->divisionId }}">{{ $value->divisionName }}</option>
                            @endif
                        @endforeach
                        </select>
                        <label for="divisionId">Division</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" value="{{ $data->email }}" placeholder="email">
                        <label for="email">email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" name="tel" id="tel" value="{{ $data->tel }}" placeholder="tel">
                        <label for="tel">Tel</label>
                      </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="address" id="address" value="{{ $data->address }}" placeholder="address">
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

  </div>
</main>
@endsection
