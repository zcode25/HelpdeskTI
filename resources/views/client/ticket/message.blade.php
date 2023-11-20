@extends('layouts.client')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Message Ticket</h1>
    <div class="row">
      <div class="col">
        @if($ticket->status != "Done")
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <form action="{{ route('client.ticket.messageSend', $ticket->ticketId) }}" method="POST">
                @csrf
                <input id="message" type="hidden" name="message">
                <trix-editor input="message"></trix-editor>
                <div class="d-grid gap-2 mt-3">
                  <button type="submit" name="status" value="send" class="btn btn-primary">Send</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif
        <div class="col-xl-12">
          @foreach ($message_details as $message_detail)
          <div class="card">
            <div class="card-body">
              <p class="card-text mb-1"><strong>{{ $message_detail->messageSender }}</strong></p>
              <p class="card-text"><small class="text-navy">{{ $message_detail->created_at->diffForHumans() }}</small></p>
              <hr>
              <p class="card-text">{!! $message_detail->message !!}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-xl-4">
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
      
      
    </div>
     
  </div>
</main>

@endsection