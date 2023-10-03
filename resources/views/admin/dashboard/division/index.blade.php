@extends('layouts.admin')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Division</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h5 class="card-title mb-0">Division Data</h5> --}}
            <a href="{{ route('division.create') }}" class="btn btn-primary">Create</a>
          </div>
          <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">divisionId</th>
                    <th scope="col">divisionName</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                  <tr>
                    <td>{{ $value->divisionId }}</td>
                    <td>{{ $value->divisionName }}</td>
                    <td>
                        <form action="{{ route('division.destroy', $value->divisionId) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('division.edit', $value->divisionId) }}" class="btn btn-secondary">Edit</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            {{-- <h5 class="card-title mb-0">Empty card</h5> --}}
            <form action="/admin/division/store" method="post">
                @csrf
                divisionName <input type="text" name="divisionName" required="required"> <br/>
                <input type="submit" value="Simpan Data">
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
