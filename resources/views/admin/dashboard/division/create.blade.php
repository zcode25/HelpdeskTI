@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Division</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <form method="POST" action="{{ route('division.store') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="divisionName" placeholder="divisionName">
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="col-sm-12 btn btn-primary">Submit</button>
                    </div>
              </form>
            {{-- <form action="/admin/division/store" method="post">
                @csrf
                divisionName <input type="text" name="divisionName" required="required"> <br/>
                <input type="submit" value="Simpan Data">
            </form> --}}
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
