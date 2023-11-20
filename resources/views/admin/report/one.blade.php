<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>

    .page-break {
        page-break-after: always;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      font-size: 12px;
    }

    table, th, td {
      /* border:1px solid black; */
      border-collapse: collapse;
    }

    th, td {
      border-bottom: 1px solid #ddd;
      padding: 5px;
    }

    td {
      vertical-align: top;
    }

    .ttd td {
      border:none;
    }
  </style>
  <title>Ticket Report ({{ $ticket->ticketNumber }})</title>
</head>
<body>
    <div>
      <p style="font-size: 20px; font-weight:bold;">Ticket Report ({{ $ticket->ticketNumber }})</p>
      {{-- <img src="{{ asset('/img/cdp.png') }}" alt=""> --}}
    </div>
    <table style="width:100%">
      <tr>
        <td style="width:50%">
          <p>Ticket Number : <strong>{{ $ticket->ticketNumber }}</strong></p>
          <p>Date  : {{ $ticket->created_at }}</p>
          <p>Requested by  : {{ $ticket->client->employee->name }}</p>
        </td>
        <td style="width:50%">
          <p>Status : <strong>{{ $ticket->status }}</strong></p>
          <p>Technician : @isset($ticket->techId) {{ $ticket->technician->employee->name }} @endisset </p>
          <p>Expec Done  : {{ $ticket->expecDone }}</p>
          <p>Date Done  : @if ($ticket->status == 'Done') {{ $ticket->updated_at }} @endif</p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p>Request :</p>
          <p>{{ $ticket->request }}</p>
        </td>
      <tr>
        <td colspan="2">
          <p>Request Description : </p>
          <p>{{ $ticket->requestDesc }}</p>
        </td>
      </tr>
    </table>

    <br /><br /><br /><br />
    <table class="ttd" style="width:100%; text-align: center">
      <tr>
        <td>Requester</td>
        <td>Recipient</td>
        @isset($ticket->techId) <td>Worker</td> @endisset
      </tr>
      <tr>
        <td><br><br><br><br><br></td>
        <td><br><br><br><br><br></td>
        @isset($ticket->techId) <td><br><br><br><br><br></td> @endisset
      </tr>
      <tr>
        <td>Client</td>
        <td>IT Helpdesk</td>
        @isset($ticket->techId) <td>Technician</td> @endisset
      </tr>
    </table>

    <div class="page-break"></div>
    <p style="font-size: 16px; font-weight:bold;">Status History</p>
    <table style="width:100%">
      @foreach ($ticket_details as $ticket_detail)
      <tr>
        <td>
          <div class="d-flex align-items-start">
            <div><i class="me-2 text-primary" data-feather="circle"></i></div>
            <div class="flex-grow-1">
              {{-- <small class="float-end text-navy">{{ $detailTiket->created_at->diffForHumans() }}</small> --}}
              <p><strong>{{ $ticket_detail->status }}</strong></p>
              <p>{{ $ticket_detail->statusDesc }}</p>
              @isset($ticket_detail->statusNote)
                  <p>Notes : {{ $ticket_detail->statusNote }}</p>
              @endisset
            </div>
          </div>
        </td>
        <td>
          <p class="text-muted">{{ $ticket_detail->created_at }}</p>
        </td>
      </tr>
      @endforeach
    </table>
          {{-- {{ dd($detailTikets) }} --}}

            
          
    
</body>
</html>