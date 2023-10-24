@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">skill</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h5 class="card-title mb-0">skill Data</h5> --}}
            <a href="{{ route('skill.create') }}" class="btn btn-primary">Create</a>
          </div>
          <div class="card-body">
              <form action="{{ route('skill.update', $data->skillId) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="text" class="form-control-plaintext" value="{{ $data->skillId }}" name="skillId" readonly>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="skillCategory">skillCategory</label>
                        <select name="skillCategory" id="role" class="form-control">
                            @foreach($data2 as $value)
                                @if ($value['skillCategory'] == $data->skillCategory)
                                    <option value="{{ $value['skillCategory'] }}" selected = "selected">{{ $value['skillCategory'] }}</option>
                                @else
                                    <option value="{{ $value['skillCategory'] }}">{{ $value['skillCategory'] }}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label for="skillName">skillName</label>
                      <input type="text" class="form-control" value="{{ $data->skillName }}" name="skillName">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <label for="skillDesc">skillDesc</label>
                      <input type="text" class="form-control" value="{{ $data->skillDesc }}" name="skillDesc">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="certificate">certificate</label>
                      <input type="text" class="form-control" value="{{ $data->certificate }}" name="certificate">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                    </div>
              </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
