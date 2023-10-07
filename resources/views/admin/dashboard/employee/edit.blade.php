@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">employee</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
              <form action="{{ route('employee.update', $data->employeeId) }}" method="POST">
              @csrf
              @method('PUT')
                <div class="form-group row">
                    <div class="col-sm-1">
                    <input type="text" class="form-control-plaintext" value="{{ $data->employeeId }}" name="employeeId">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                    </div>

                    <div class="col-sm-1">
                        <select name="divisionId" class="form-control">
                        @foreach($data2 as $value)
                            @if ($value->divisionId == $data->division->divisionId)
                                <option value="{{ $value->divisionId }}" selected = "selected">{{ $value->divisionName }}</option>
                            @else
                                <option value="{{ $value->divisionId }}">{{ $value->divisionName }}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="email" class="form-control" name="email" value="{{ $data->email }}" placeholder="email">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="tel" value="{{ $data->tel }}" placeholder="tel">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="address" value="{{ $data->address }}" placeholder="address">
                    </div>
                    <div class="col-sm-2">
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
