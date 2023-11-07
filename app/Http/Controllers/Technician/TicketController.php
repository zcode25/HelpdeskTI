<?php

namespace App\Http\Controllers\Technician;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index() {
        return view('technician.ticket.index', [
            'tickets'    => Ticket::where('techId', auth()->user()->userId)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function assignmentDetail(Ticket $ticket) {
        return view('technician.ticket.assignmentDetail', [
            'ticket'              => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get(),
            'technician'         => User::where('role', 'technician')->get()
        ]);
    }

    public function assignment(Request $request, Ticket $ticket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update($validatedData);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');

        $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' mengerjakan tiket (' . $request->ticketNumber . ').';
        
        TicketDetail::Create($ticketDetail);

        return redirect('/technician/ticket')->with('success', 'Data ticket berhasil diperbaruhi');
    }

    public function validationDetail(Ticket $ticket) {
        return view('technician.ticket.validationDetail', [
            'ticket'              => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get(),
            'technician'         => User::where('role', 'technician')->get()
        ]);
    }

    public function validation(Request $request, Ticket $ticket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update($validatedData);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');

        $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' telah mengerjakan tiket (' . $request->ticketNumber . '). Mohon untuk divalidasi oleh user.';
        
        TicketDetail::Create($ticketDetail);

        return redirect('/technician/ticket')->with('success', 'Data ticket berhasil diperbaruhi');
    }

    public function detail(Ticket $ticket) {
        return view('technician.ticket.detail', [
            'ticket'         => $ticket,
            'ticket_details' => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ]);
    }
}
