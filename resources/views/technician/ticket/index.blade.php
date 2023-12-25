@extends('layouts.technician')
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
                {{-- <a href="/admin/departemen/create" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="user-plus"></i> <span class="align-middle">Tambah Departemen</span></a> --}}
                <div class="table-responsive">
                <table class="table my-0 table-sm" id="myTableTicket">
									<thead>
										<tr>
											<th>Ticket Number</th>
											<th>Status</th>
                      <th>Request</th>
                      <th>Client</th>
                      <th>Priority</th>
                      <th>Sent</th>
                      <th>Expec Done</th>
                      <th>Done</th>
                      <th>Time</th>
                      <th>Action</th>
										</tr>
									</thead>
									<tbody>
                    @foreach ($tickets as $ticket)
                    @php
                        $awal  = time(); //waktu awal
                        $akhir = strtotime($ticket->expecDone); //waktu akhir
                        $diff  = $akhir - $awal;
                        $jam   = floor($diff / (60 * 60));
                        $menit = $diff - $jam * (60 * 60);
                        $menit = floor( $menit / 60 );
                    @endphp
										<tr>
											<td class="align-baseline">{{ $ticket->ticketNumber }}</td>
                      <td class="align-baseline">{{ $ticket->status }}</td>
											<td class="align-baseline">{{ $ticket->request }}</td>
											<td class="align-baseline">{{ $ticket->client->employee->name }}</td>
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
                      @if ($ticket->status != "Sent" && $ticket->status != "Accepted" && $ticket->status != "On Hold" && $ticket->status != "Rejected" && $ticket->status != "Done")
                        <td class="text-danger fw-bold align-baseline">{{ $jam }} Jam {{ $menit }} Menit</td>
                      @else
                        <td class="align-baseline">-</td>
                      @endif
                      @if ($ticket->status == "Assignment" || $ticket->status == "Complaint Assignment")
                      <td class="align-baseline">
                        <a href="{{ route('technician.ticket.assignmentDetail', $ticket->ticketId) }}" class="btn btn-primary btn-sm" title="Detail"><i class="align-middle" data-feather="edit"></i></a>
                        <a href="{{ route('technician.ticket.message', $ticket->ticketId) }}" class="btn btn-warning btn-sm" title="Message"><i class="align-middle" data-feather="inbox"></i></a>
                      </td>
                      @elseif ($ticket->status == "Worked on")
                      <td class="align-baseline">
                        <a href="{{ route('technician.ticket.validationDetail', $ticket->ticketId) }}" class="btn btn-primary btn-sm" title="Detail"><i class="align-middle" data-feather="edit"></i></a>
                        <a href="{{ route('technician.ticket.message', $ticket->ticketId) }}" class="btn btn-warning btn-sm" title="Message"><i class="align-middle" data-feather="inbox"></i></a>
                      </td>
                      @elseif ($ticket->status == "Validation" || $ticket->status == "Done" || $ticket->status == "Complaint On Hold" || $ticket->status == "Complaint" || $ticket->status == "Complaint Accepted")
                      <td class="align-baseline">
                        <a href="{{ route('technician.ticket.detail', $ticket->ticketId) }}" class="btn btn-primary btn-sm" title="Detail"><i class="align-middle" data-feather="edit"></i></a>
                        <a href="{{ route('technician.ticket.message', $ticket->ticketId) }}" class="btn btn-warning btn-sm" title="Message"><i class="align-middle" data-feather="inbox"></i></a>
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