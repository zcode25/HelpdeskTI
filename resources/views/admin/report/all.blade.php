<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      font-size: 12px;
    }

    table, th, td {
      border-collapse: collapse;
    }

    th {
      background-color: #222E3C;
      color: white;
      text-align: left;
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
  <title>All Tickets Report</title>
</head>
<body>
    <div>
      <p style="font-size: 20px; font-weight:bold">All Tickets Report</p>
      <p>Date : {{ date('d M Y') }}</p>
      <br>
    </div>
    <table style="width:100%">
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
      </tr>
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
      </tr>
      @endforeach
    </table>
    <br />
    <br />
    <table class="ttd" style="width:100%; text-align:center; border:none">
      <tr>
        <td tyle="width:50%;">Checker</td>
        <td>Know</td>
      </tr>
      <tr>
        <td><br><br><br><br><br></td>
        <td><br><br><br><br><br></td>
      </tr>
      <tr>
        <td>IT Helpdesk</td>
        <td>IT Head Dept</td>
      </tr>
    </table>
</body>
</html>