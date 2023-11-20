<?php

namespace App\Http\Controllers\Technician;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageDetail;

class TicketController extends Controller
{
    public function index() {
        return view('technician.ticket.index', [
            'tickets'    => Ticket::where('techId', auth()->user()->userId)->orderBy('created_at', 'desc')->get(),
            'go_on'   => Ticket::whereNot('status', 'Rejected')->where('techId', auth()->user()->userId)->whereNot('status', 'Done')->count(),
            'done'   => Ticket::where('status', 'Done')->where('techId', auth()->user()->userId)->count(),
            'complaint'   => Ticket::where('status', 'Complaint')->where('techId', auth()->user()->userId)->count(),
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
            'statusNote'        => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update([
            'status'    => $validatedData['status'],
        ]);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');

        $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' work on ticket (' . $request->ticketNumber . ').';
        
        TicketDetail::Create($ticketDetail);

        return redirect('/technician/ticket')->with('success', 'Ticket data updated successfully');
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
            'statusNote'        => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update([
            'status'    => $validatedData['status'],
        ]);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');

        $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' have worked on ticket (' . $request->ticketNumber . '). Please validate by the client.';
        
        TicketDetail::Create($ticketDetail);

        return redirect('/technician/ticket')->with('success', 'Ticket data updated successfully');
    }

    public function detail(Ticket $ticket) {
        return view('technician.ticket.detail', [
            'ticket'         => $ticket,
            'ticket_details' => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function message(Ticket $ticket) {

        $message =  Message::where('ticketId', $ticket->ticketId)->first();

        return view('technician.ticket.message', [
            'ticket'         => $ticket,
            'ticket_details' => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get(),
            'message_details' => MessageDetail::where('messageId', $message->messageId)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function messageSend(Ticket $ticket, Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'message'            => 'required',
        ]);

        $message =  Message::where('ticketId', $ticket->ticketId)->first();

        $validatedData['messageDetailId'] = Str::uuid();
        $validatedData['messageId'] = $message->messageId;
        $validatedData['messageSender'] = auth()->user()->Employee->name;
        $validatedData['messageDate'] = date('Y-m-d');

        MessageDetail::create($validatedData);

        return back();
    }
}
