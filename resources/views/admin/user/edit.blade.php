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
      <div class="col-xl-12 mb-4">
        <ul class="nav nav-pills nav-fill bg-white" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-user-tab" data-bs-toggle="pill" data-bs-target="#pills-user" type="button" role="tab" aria-controls="pills-user" aria-selected="true">Employee Data</button>
          </li>
          @if($data->employee->division->divisionId == 'DV001')
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-skill-tab" data-bs-toggle="pill" data-bs-target="#pills-skill" type="button" role="tab" aria-controls="pills-skill" aria-selected="false">Skill</button>
          </li>
          @endif
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="false">Account</button>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab" tabindex="0">
            <div class="row">
              <div class="col-xl-6">
                <div class="card">
                  <div class="card-body">
                    <form action="{{ route('user.update', $data->userId) }}" method="POST">
                    @csrf
                    @method('PUT')
                      <div class="form-group">
                        <input type="hidden" class="form-control-plaintext" value="{{ $data->userId }}" name="userId">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control @error('employeeId') is-invalid @enderror" id="employeeId" name="employeeId" placeholder="Employee Id" value="{{ old('employeeId', $data->employee->employeeId) }}" readonly>
                          <label for="employeeId">Employee Id</label>
                          @error('employeeId') 
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="name" value="{{ old('name', $data->employee->name) }}">
                          <label for="name">Name</label>
                          @error('name') 
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-floating mb-3">
                          <select name="divisionId" id="divisionId" class="form-control">
                            @foreach($data2 as $value)
                                @if ($value['divisionName'] == $data->employee->division->divisionName)
                                    <option value="{{ $value['divisionId'] }}" selected = "selected">{{ $value['divisionName'] }}</option>
                                @else
                                    <option value="{{ $value['divisionId'] }}">{{ $value['divisionName'] }}</option>
                                @endif
                            @endforeach
                          </select>
                          <label for="divisionId">Division</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{ old('email', $data->employee->email) }}">
                          <label for="email">Email</label>
                          @error('email') 
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-floating mb-3">
                          <input type="tel" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel" placeholder="Phone Number" value="{{ old('tel', $data->employee->tel) }}">
                          <label for="tel">Phone Number</label>
                          @error('tel') 
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="address" value="{{ old('address', $data->employee->address) }}">
                          <label for="address">Address</label>
                          @error('address') 
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
      
                        <div class="form-floating mb-3">
                            <button type="submit" class="col-sm-12 btn btn-primary">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-skill" role="tabpanel" aria-labelledby="pills-skill-tab" tabindex="0">
            <div class="row">
              <div class="col-xl-6">
                <div class="card">
                  <div class="card-body">
                    <form action="{{ route('user.createSkill') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group">
                          <input type="hidden" class="form-control-plaintext" value="{{ $data->userId }}" name="userId">
                          <div class="form-floating mb-3">
                            <select name="categoryId" id="categoryId" class="form-control">
                              @foreach ($data4 as $value)
                                  @if (old('categoryId') == $value->categoryId)
                                      <option value="{{ $value->categoryId }}" selected>{{ $value->categoryName }}</option>
                                      @else
                                      <option value="{{ $value->categoryId }}">{{ $value->categoryName }}</option>
                                  @endif
                              @endforeach
                            </select>
                            <label for="categoryId">Category</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('skillName') is-invalid @enderror" id="skillName" name="skillName" placeholder="skillName" value="{{ old('skillName') }}">
                            <label for="skillName">Skill Name</label>
                            @error('skillName') 
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('skillDesc') is-invalid @enderror" id="skillDesc" name="skillDesc" placeholder="skillDesc" value="{{ old('skillDesc') }}">
                            <label for="skillDesc">Skill Description</label>
                            @error('skillDesc') 
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="certificate" class="form-label">Uploud Certificate</label>
                            <input class="form-control @error('certificate') is-invalid @enderror" type="file" id="certificate" name="certificate" multiple>
                            @error('certificate') 
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
    
                          <div class="form-floating mb-3">
                              <button type="submit" class="col-sm-12 btn btn-primary">Save</button>
                          </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table" id="myTable">
                      <thead>
                        <tr>
                          <th scope="col">Skill Name</th>
                          <th scope="col">Skill Desc</th>
                          <th scope="col">Category</th>
                          <th scope="col">Certificate</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data5 as $value)
                        <tr>
                          <td>{{ $value->skillName }}</td>
                          <td>{{ $value->skillDesc }}</td>
                          <td>{{ $value->category->categoryName }}</td>
                          <td>
                              <form action="{{ route('user.destroySkill', $value->skillTechId) }}" method="POST">
                                  <a href="{{ asset('storage/' . $value->certificate) }}" target="_blank" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="download"></i></a>
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="align-middle" data-feather="trash"></i></button>
                              </form>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
            <div class="row">
              <div class="col-xl-6">
                <div class="card">
                  <div class="card-body">
                    <form action="{{ route('user.updateRole', $data->userId) }}" method="POST">
                    @csrf
                    @method('PUT')
                      <div class="form-group">
                          <div class="form-floating mb-3">
                            <select name="role" id="role" class="form-control">
                            @foreach($data3 as $value)
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
                              <button type="submit" class="col-sm-12 btn btn-primary">Update Role</button>
                          </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <form action="{{ route('user.resetPassword', $data->userId) }}" method="POST">
                    @csrf
                    @method('PUT')
                      <div class="form-group">
                        <div class="form-floating"> 
                            <button type="submit" class="col-sm-12 btn btn-danger" onclick="return confirm('Are you sure?')">Reset Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
