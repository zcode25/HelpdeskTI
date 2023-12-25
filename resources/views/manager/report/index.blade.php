@extends('layouts.manager')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Report</h1>
        @if (session()->has('success'))  
          <div class="badge bg-success text-white mb-2">
            {{ session('success') }}
          </div>
        @endif
        @if (session()->has('error'))  
          <div class="badge bg-danger text-white mb-2">
            {{ session('error') }}
          </div>
        @endif
      
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <form class="row g-3" action="{{ route('manager.report.target') }}" method="GET">
                  @csrf
                  <div class="col-auto">
                    <label for="fromDate" class="visually-hidden">From Date</label>
                    <input type="date" class="form-control form-control-sm" id="fromDate" name="fromDate" placeholder="From Date" required>
                  </div>
                  <div class="col-auto">
                    <label for="untilDate" class="visually-hidden">Until Date</label>
                    <input type="date" class="form-control form-control-sm" id="untilDate" name="untilDate" placeholder="Until Date" required>
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-sm mb-3" formtarget="_blank"><i data-feather="printer"></i></button>
                  </div>
                  <div class="col-auto">
                    <a href="{{ route('manager.report.all') }}" target="_Blank" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="printer"></i> <span class="align-middle">Print All Ticket</span></a>
                  </div>
                </form>
                <div class="table-responsive mt-3">
                <table class="table my-0 table-sm" id="myTable">
									<thead>
										<tr>
											<th>Ticket Number</th>
											<th>Status</th>
											<th>Request</th>
                      <th>Client</th>
                      <th>Technician</th>
                      <th>Priority</th>
                      <th>Sent</th>
                      <th>Expec Done</th>
                      <th>Done</th>
                      <th>Action</th>
										</tr>
									</thead>
									<tbody>
                    @foreach ($tickets as $ticket)
										<tr>
											<td class="align-baseline">{{ $ticket->ticketNumber }}</td>
                      <td class="align-baseline">{{ $ticket->status }}</td>
                      <td class="align-baseline">{{ $ticket->request }}</td>
											<td class="align-baseline">{{ $ticket->client->employee->name }}</td>
                      @if (isset($ticket->techId))
											  <td class="align-baseline">{{ $ticket->technician->employee->name }}</td>
                      @else
                        <td class="align-baseline">-</td>
                      @endif
                      @if (isset($ticket->priority))
											  <td class="align-baseline">{{ $ticket->priority }}</td>
                      @else
                        <td class="align-baseline">-</td>
                      @endif
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
                      <td><a href="{{ route('manager.report.one', $ticket->ticketId) }}" target="_Blank" class="btn btn-primary btn-sm"><i  data-feather="printer"></i> <span class="align-middle"></span></a></td>
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