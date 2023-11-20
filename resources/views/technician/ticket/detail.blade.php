@extends('layouts.technician')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Detail Tiket</h1>
    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <form action="" method="POST">
              @csrf
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('ticketNumber') is-invalid @enderror" id="ticketNumber" name="ticketNumber" value="{{ $ticket->ticketNumber }}" autocomplete="off" readonly="on">
                <label for="ticketNumber">Ticket Number</label>
                @error('ticketNumber') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('created_at') is-invalid @enderror" id="created_at" name="created_at" value="{{ $ticket->created_at }}" autocomplete="off" readonly="on">
                <label for="created_at" class="form-label">Sent</label>
                @error('created_at') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('clientId') is-invalid @enderror" id="clientId" name="clientId" value="{{ old('clientId', $ticket->client->employee->name) }}" autocomplete="off" readonly="on">
                <label for="clientId">Client</label>
                @error('clientId')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('divisionId') is-invalid @enderror" id="divisionId" name="divisionId" value="{{ old('divisionId', $ticket->client->employee->division->divisionName) }}" autocomplete="off" readonly="on">
                <label for="divisionId" class="form-label">Division</label>
                @error('divisionId')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('request') is-invalid @enderror" id="request" name="request" value="{{ old('request', $ticket->request) }}" autocomplete="off" readonly="on">
                <label for="request" class="form-label">Request</label>
                @error('request')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('requestDesc') is-invalid @enderror" id="requestDesc" name="requestDesc" value="{{ old('requestDesc', $ticket->requestDesc) }}" autocomplete="off" readonly="on">
                <label for="requestDesc" class="form-label">Request Description</label>
                @error('requestDesc')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('categoryId') is-invalid @enderror" id="categoryId" name="categoryId" value="{{ old('categoryId', $ticket->category->categoryName) }}" autocomplete="off" readonly="on">
                <label for="categoryId" class="form-label">Category</label>
                @error('categoryId')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              @if ($ticket->requestPict)
                <img src="{{ asset('storage/' . $ticket->requestPict) }}" alt="$ticket->ticketNumber" class="img-fluid mt-3">
              @endif
              @isset($ticket->techId)
              <hr />
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('priority') is-invalid @enderror" id="priority" name="priority" value="{{ old('priority', $ticket->priority) }}" autocomplete="off" readonly="on">
                <label for="priority" class="form-label">Priorty</label>
                @error('priority')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('techId') is-invalid @enderror" id="techId" name="techId" value="{{ old('techId', $ticket->technician->employee->name) }}" autocomplete="off" readonly="on">
                <label for="techId" class="form-label">Technician</label>
                @error('techId')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-0">
                <input type="text" class="form-control-plaintext @error('expecDone') is-invalid @enderror" id="expecDone" name="expecDone" value="{{ old('expecDone', $ticket->expecDone) }}" autocomplete="off" readonly="on">
                <label for="expecDone" class="form-label">Expec Done</label>
                @error('expecDone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              @endisset
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Histori Status</h5>
          </div>
          <div class="card-body h-100">
            @foreach ($ticket_details as $ticket_detail)

              <div class="d-flex align-items-start">
                <div><i class="me-2 text-primary" data-feather="circle"></i></div>
                <div class="flex-grow-1">
                  <small class="float-end text-navy">{{ $ticket_detail->created_at->diffForHumans() }}</small>
                  <strong>{{ $ticket_detail->status }}</strong><br />
                  <span>{{ $ticket_detail->statusDesc }}</span><br />
                  @isset($ticket_detail->statusNote)
                  <div>
                    <a class="text-sm link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" data-bs-toggle="collapse" href="#collapse{{ $ticket_detail->ticketDetailId }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Lihat Detail
                    </a>
                  </div>
                  <div class="collapse" id="collapse{{ $ticket_detail->ticketDetailId }}">
                    <div class="border text-sm text-muted p-2 mt-1 md-2">
                      {{ $ticket_detail->statusNote }}
                    </div>
                  </div>
                  @endisset
                  <small class="text-muted">{{ $ticket_detail->created_at }}</small><br />
                </div>
              </div>
              <hr />
            @endforeach
          
          </div>
        </div>
      </div>
    </div>
     
  </div>
</main>

@endsection