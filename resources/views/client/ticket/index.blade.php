@extends('layouts.client')
@section('container')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Ticket</h1>
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
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ route('client.ticket.create') }}" class="btn btn-primary btn-sm mb-4"><i class="align-middle me-2" data-feather="sidebar"></i><span class="align-middle"> Create Ticket</span></a>
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">Ticket Number</th>
                  <th scope="col">Status</th>
                  <th scope="col">Request</th>
                  <th scope="col">Category</th>
                  <th scope="col">Sent</th>
                  <th scope="col">Expec</th>
                  <th scope="col">Done</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($tickets as $ticket)
                <tr>
                  <td class="align-baseline">{{ $ticket->ticketNumber }}</td>
                  <td class="align-baseline">{{ $ticket->status }}</td>
                  <td class="align-baseline">{{ $ticket->request }}</td>
                  <td class="align-baseline">{{ $ticket->categoryId }}</td>
                  <td class="align-baseline">{{ $ticket->created_at->format('d/m/y H:i') }}</td>
                  @if (isset($ticket->expecDone))
                    <td class="align-baseline">{{ date('d/m/y H:i', strtotime($ticket->expecDone)) }}</td>
                  @else
                    <td class="align-baseline">-</td>
                  @endif
                  @if ($ticket->status == "Done")
                    <td class="align-baseline">{{ $ticket->updated_at->format('d/m/y H:i') }}</td>
                  @else
                    <td class="align-baseline">-</td>
                  @endif
                  @if ($ticket->status == "Validation")
                  <td class="align-baseline">
                    <a href="{{ route('client.ticket.validationDetail', $ticket->ticketId) }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>
                  </td>
                  @else
                  <td class="align-baseline">
                    <a href="{{ route('client.ticket.detail', $ticket->ticketId) }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>
                  </td>
                  @endIf
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection