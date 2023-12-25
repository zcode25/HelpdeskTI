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
      <span>{{ session('error') }}</span>
      <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col mt-0">
                <h5 class="card-title">Sent</h5>
              </div>
              <div class="col-auto">
                <div class="bg-info text-white p-2 rounded-3">
                  <i class="align-middle" data-feather="mail"></i>
                </div>
              </div>
            </div>
            <h1 class="mt-1 mb-3">{{ $sent }}</h1>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col mt-0">
                <h5 class="card-title">On Hold</h5>
              </div>
              <div class="col-auto">
                <div class="bg-warning text-white p-2 rounded-3">
                  <i class="align-middle" data-feather="loader"></i>
                </div>
              </div>
            </div>
            <h1 class="mt-1 mb-3">{{ $on_hold }}</h1>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col mt-0">
                <h5 class="card-title">Rejected</h5>
              </div>
              <div class="col-auto">
                <div class="bg-danger text-white p-2 rounded-3">
                  <i class="align-middle" data-feather="x-circle"></i>
                </div>
              </div>
            </div>
            <h1 class="mt-1 mb-3">{{ $rejected }}</h1>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col mt-0">
                <h5 class="card-title">Go On</h5>
              </div>
              <div class="col-auto">
                <div class="bg-primary text-white p-2 rounded-3">
                  <i class="align-middle" data-feather="send"></i>
                </div>
              </div>
            </div>
            <h1 class="mt-1 mb-3">{{ $go_on }}</h1>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col mt-0">
                <h5 class="card-title">Done</h5>
              </div>
              <div class="col-auto">
                <div class="bg-success text-white p-2 rounded-3">
                  <i class="align-middle" data-feather="check-circle"></i>
                </div>
              </div>
            </div>
            <h1 class="mt-1 mb-3">{{ $done }}</h1>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col mt-0">
                <h5 class="card-title">Complaint</h5>
              </div>
              <div class="col-auto">
                <div class="bg-danger text-white p-2 rounded-3">
                  <i class="align-middle" data-feather="alert-circle"></i>
                </div>
              </div>
            </div>
            <h1 class="mt-1 mb-3">{{ $complaint }}</h1>
          </div>
        </div>
      </div>
      
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ route('client.ticket.create') }}" class="btn btn-primary btn-sm mb-4"><i class="align-middle me-2" data-feather="sidebar"></i><span class="align-middle"> Create Ticket</span></a>
            <div class="table-responsive">
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">Ticket Number</th>
                  <th scope="col">Status</th>
                  <th scope="col">Request</th>
                  <th scope="col">Technician</th>
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
                  @if (isset($ticket->techId))
									  <td class="align-baseline">{{ $ticket->technician->employee->name }}</td>
                  @else
                    <td class="align-baseline">-</td>
                  @endif
                  <td class="align-baseline">{{ $ticket->category->categoryName }}</td>
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
                    <a href="{{ route('client.ticket.validationDetail', $ticket->ticketId) }}" class="btn btn-primary btn-sm" title="Detail"><i class="align-middle" data-feather="edit"></i></a>
                    <a href="{{ route('client.ticket.message', $ticket->ticketId) }}" class="btn btn-warning btn-sm" title="Message"><i class="align-middle" data-feather="inbox"></i></a>
                  </td>
                  @else
                  <td class="align-baseline">
                    <a href="{{ route('client.ticket.detail', $ticket->ticketId) }}" class="btn btn-primary btn-sm" title="Detail"><i class="align-middle" data-feather="edit"></i></a>
                    @if ($ticket->status == "Assignment" || $ticket->status == "Worked on" || $ticket->status == "Complaint On Hold" || $ticket->status == "Complaint" || $ticket->status == "Complaint Accepted" || $ticket->status == "Complaint Assignment" || $ticket->status == "Done")
                      <a href="{{ route('client.ticket.message', $ticket->ticketId) }}" class="btn btn-warning btn-sm" title="Message"><i class="align-middle" data-feather="inbox"></i></a>
                    @endif  
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

  </div>
</main>
@endsection