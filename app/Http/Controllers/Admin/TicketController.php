<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\TechSkill;
use Illuminate\Support\Str;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index() {
        return view('admin.ticket.index', [
            'tickets'    => Ticket::orderBy('created_at', 'desc')->get(),
            'sent'   => Ticket::where('status', 'Sent')->count(),
            'on_hold'   => Ticket::where('status', 'On Hold')->count(),
            'rejected'   => Ticket::where('status', 'Rejected')->count(),
            'go_on'   => Ticket::whereNot('status', 'Rejected')->whereNot('status', 'Done')->count(),
            'done'   => Ticket::where('status', 'Done')->count(),
            'complaint'   => Ticket::where('status', 'Complaint')->count(),
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

        if ($ticketDetail['status'] == "Accepted") {
            $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' accept ticket (' . $request->ticketNumber . ').';
        } elseif ($ticketDetail['status'] == "On Hold") {
            $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' hold ticket (' . $request->ticketNumber . ').';
        } else {
            $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' reject ticket (' . $request->ticketNumber . ').';
        }
        
        TicketDetail::Create($ticketDetail);

        return redirect('/admin/ticket')->with('success', 'Ticket data has been successfully created');
    }

    public function assignmentDetail(Ticket $ticket) {
        $priorities = [
            [
                "priority" => "Low"
            ],
            [
                "priority" => "Middle"
            ],
            [
                "priority" => "High"
            ],
        ];


        return view('admin.ticket.assignmentDetail', [
            'ticket'              => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get(),
            'technician'         => TechSkill::where('categoryId', $ticket->categoryId)->get(),
            'priorities'          => $priorities
        ]);
    }

    public function assignment(Request $request, Ticket $ticket) {
        
        $validatedData = $request->validate([
            'status'            => 'required',
            'techId'      => 'required',
            'priority'         => 'required',
            'expecDone'         => 'required',
            'statusNote'         => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update([
            'status'            => $validatedData['status'],
            'techId'            => $validatedData['techId'],
            'priority'         => $validatedData['priority'],
            'expecDone'         => $validatedData['expecDone'],
        ]);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');
        

        $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' assign technician to work on tickets (' . $request->ticketNumber . ').';

        
        TicketDetail::Create($ticketDetail);
        
        $message['messageId'] = Str::uuid();
        $message['ticketId'] =  $ticket->ticketId;

        Message::create($message);

        return redirect('/admin/ticket')->with('success', 'Ticket data updated successfully');
    }

    public function detail(Ticket $ticket) {
        return view('admin.ticket.detail', [
            'ticket'    => $ticket,
            'ticket_details' => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function complaintConfirmationDetail(Ticket $ticket) {
        return view('admin.ticket.complaintConfirmationDetail', [
            'ticket'             => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function confirmationComplaint(Request $request, Ticket $ticket) {
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

        if ($ticketDetail['status'] == "Complaint Accepted") {
            $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' accept ticket complaint (' . $request->ticketNumber . ').';
        } elseif ($ticketDetail['status'] == "Complaint On Hold") {
            $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' hold ticket complaint (' . $request->ticketNumber . ').';
        } 
        // else {
        //     $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' reject ticket (' . $request->ticketNumber . ').';
        // }
        
        TicketDetail::Create($ticketDetail);

        return redirect('/admin/ticket')->with('success', 'Ticket data updated successfully');
    }

    public function complaintAssignmentDetail(Ticket $ticket) {
        
        $priorities = [
            [
                "priority" => "Low"
            ],
            [
                "priority" => "Middle"
            ],
            [
                "priority" => "High"
            ],
        ];

        return view('admin.ticket.complaintAssignmentDetail', [
            'ticket'              => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get(),
            'technician'         => User::where('role', 'technician')->get(),
            'priorities'          => $priorities
        ]);
    }

    public function assignmentComplaint(Request $request, Ticket $ticket) {
        
        $validatedData = $request->validate([
            'status'            => 'required',
            'statusNote'         => 'required',
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update([
            'status'            => $validatedData['status'],
        ]);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');


        $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' assign technician to work on ticket complaint (' . $request->ticketNumber . ').';

        
        TicketDetail::Create($ticketDetail);

        return redirect('/admin/ticket')->with('success', 'Ticket data updated successfully');
    }
}
