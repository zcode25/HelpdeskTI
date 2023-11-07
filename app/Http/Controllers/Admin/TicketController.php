<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class TicketController extends Controller
{
    public function index() {
        return view('admin.ticket.index', [
            'tickets'    => Ticket::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function confirmationDetail(Ticket $ticket) {
        return view('admin.ticket.confirmationDetail', [
            'ticket'             => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function confirmation(Request $request, Ticket $ticket) {
        $validatedData = $request->validate([
            'status'            => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update($validatedData);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');

        if ($ticketDetail['status'] == "Accepted") {
            $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' menerima ticket (' . $request->ticketNumber . ').';
        } elseif ($ticketDetail['status'] == "On Hold") {
            $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' menahan ticket (' . $request->ticketNumber . ').';
        } else {
            $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' menolak ticket (' . $request->ticketNumber . ').';
        }
        
        TicketDetail::Create($ticketDetail);

        return redirect('/admin/ticket')->with('success', 'Data ticket berhasil diperbaruhi');
    }

    public function assignmentDetail(Ticket $ticket) {
        return view('admin.ticket.assignmentDetail', [
            'ticket'              => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get(),
            'technician'         => User::where('role', 'technician')->get()
        ]);
    }

    public function assignment(Request $request, Ticket $ticket) {
        // dd($request);
        $validatedData = $request->validate([
            'status'            => 'required',
            'techId'      => 'required',
            'priority'         => 'required',
            'expecDone'         => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update($validatedData);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');


        $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' menugaskan teknisi untuk mengerjakan tiket (' . $request->ticketNumber . ').';

        
        TicketDetail::Create($ticketDetail);

        return redirect('/admin/ticket')->with('success', 'Data tiket berhasil diperbaruhi');
    }

    public function detail(Ticket $ticket) {
        return view('admin.ticket.detail', [
            'ticket'    => $ticket,
            'ticket_details' => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ]);
    }
}
