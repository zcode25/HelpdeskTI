@extends('layouts.technician')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Detail Tiket</h1>
    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('technician.ticket.assignment', $ticket->ticketId) }}" method="POST">
              @csrf
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('ticketNumber') is-invalid @enderror" id="ticketNumber" name="ticketNumber" value="{{ $ticket->ticketNumber }}" autocomplete="off" readonly="on">
                <label for="ticketNumber">Ticket Number</label>
                @error('ticketNumber') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('created_at') is-invalid @enderror" id="created_at" name="created_at" value="{{ $ticket->created_at }}" autocomplete="off" readonly="on">
                <label for="created_at" class="form-label">Sent</label>
                @error('created_at') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('clientId') is-invalid @enderror" id="clientId" name="clientId" value="{{ old('clientId', $ticket->client->employee->name) }}" autocomplete="off" readonly="on">
                <label for="clientId">Client</label>
                @error('clientId')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('divisionId') is-invalid @enderror" id="divisionId" name="divisionId" value="{{ old('divisionId', $ticket->client->employee->division->divisionName) }}" autocomplete="off" readonly="on">
                <label for="divisionId" class="form-label">Division</label>
                @error('divisionId')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control @error('request') is-invalid @enderror" id="request" name="request" value="{{ old('request', $ticket->request) }}" autocomplete="off" readonly="on">
                <label for="request" class="form-label">Request</label>
                @error('request')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-floating mb-3">
                <textarea class="form-control @error('requestDesc') is-invalid @enderror" id="requestDesc" name="requestDesc" rows="3" readonly="on">{{ old('requestDesc', $ticket->requestDesc) }}</textarea>
                <label for="requestDesc" class="form-label">Request Description</label>
                @error('requestDesc') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <hr />
              <div class="mb-3">
                <label for="statusNote" class="form-label">Notes</label>
                <textarea class="form-control @error('statusNote') is-invalid @enderror" id="statusNote" name="statusNote" rows="3" required>{{ old('statusNote') }}</textarea>
                @error('statusNote') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="d-grid gap-2">
                <button type="submit" name="status" value="Worked on" class="btn btn-primary">Kerjakan</button>
              </div>
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