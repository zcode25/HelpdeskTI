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
            <form method="POST" action="{{ route('skill.store') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-2">
                    <select name="skillCategory" class="form-control">
                        <option value="Network">Network</option>
                        <option value="Software">Software</option>
                        <option value="Hardware">Hardware</option>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="skillName" placeholder="skillName">
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="skillDesc" placeholder="skillDesc">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="certificate" placeholder="certificate">
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
                    <th scope="col">skillId</th>
                    <th scope="col">skillCategory</th>
                    <th scope="col">skillName</th>
                    <th scope="col">skillDesc</th>
                    <th scope="col">certificate</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    <td>{{ $value->skillId }}</td>
                    <td>{{ $value->skillCategory }}</td>
                    <td>{{ $value->skillName }}</td>
                    <td>{{ $value->skillDesc }}</td>
                    <td>{{ $value->certificate }}</td>
                    <td>
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
