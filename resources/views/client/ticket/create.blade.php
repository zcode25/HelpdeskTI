@extends('layouts.client')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Create Ticket</h1>

    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('client.ticket.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              {{-- <div class="form-floating mb-3">
                <input type="date" class="form-control @error('ticketDate') is-invalid @enderror" name="ticketDate" id="ticketDate" placeholder="ticketDate" value="{{ old('ticketDate') }}">
                <label for="ticketDate">Ticket Date</label>
                @error('ticketDate') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div> --}}
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('request') is-invalid @enderror" name="request" id="request" placeholder="request" value="{{ old('request') }}">
                <label for="request">Request</label>
                @error('request') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <textarea class="form-control @error('requestDesc') is-invalid @enderror" name="requestDesc" id="requestDesc" placeholder="Request Describe" style="height: 100px">{{ old('requestDesc') }}</textarea>
                <label for="requestDesc">Request Description</label>
                @error('requestDesc') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="requestPict" class="form-label">Request Picture</label>
                <input class="form-control @error('requestPict') is-invalid @enderror" type="file" id="requestPict" name="requestPict" multiple>
                @error('requestPict') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <select name="categoryId" id="categoryId" class="form-control">
                  @foreach ($categories as $category)
                      @if (old('categoryId') == $category->categoryId)
                          <option value="{{ $category->categoryId }}" selected>{{ $category->categoryName }}</option>
                          @else
                          <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                      @endif
                  @endforeach
                </select>
                <label for="categoryId">Category</label>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection