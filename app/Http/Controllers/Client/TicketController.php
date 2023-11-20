<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageDetail;
use App\Models\Ticket;
use App\Models\TicketDetail;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TicketController extends Controller
{
    public function index() {
        return view('client.ticket.index', [
            'tickets'    => Ticket::where('clientId', auth()->user()->userId)->orderBy('created_at', 'desc')->get(),
            'sent'   => Ticket::where('status', 'Sent')->where('clientId', auth()->user()->userId)->count(),
            'on_hold'   => Ticket::where('status', 'On Hold')->where('clientId', auth()->user()->userId)->count(),
            'rejected'   => Ticket::where('status', 'Rejected')->where('clientId', auth()->user()->userId)->count(),
            'go_on'   => Ticket::whereNot('status', 'Rejected')->where('clientId', auth()->user()->userId)->whereNot('status', 'Done')->count(),
            'done'   => Ticket::where('status', 'Done')->where('clientId', auth()->user()->userId)->count(),
            'complaint'   => Ticket::where('status', 'Complaint')->where('clientId', auth()->user()->userId)->count(),
        ]);
    }

    public function create() {
        return view('client.ticket.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            // 'ticketDate'     => 'required',
            'request'        => 'required',
            'requestDesc'    => 'required',
            'requestPict'    => 'required|mimes:png,jpg|max:2048',
            'categoryId'    => 'required',
        ]);
        
        $validatedData['ticketId'] = Str::uuid();
        $validatedData['clientId'] = auth()->user()->userId;
        $validatedData['ticketNumber'] = IdGenerator::generate(['table' => 'tickets', 'field' => 'ticketNumber', 'length' => 23, 'prefix' => 'HES/IT/WO/' . date('d/m/y/')]);
        $validatedData['ticketDate'] = date('Y-m-d');
        $validatedData['status'] = 'Sent';
        
        if($request->file('requestPict')) {
            $validatedData['requestPict'] = $request->file('requestPict')->store('requestPict');
        }
        
        Ticket::create($validatedData);

        $detailTiket['ticketDetailId'] =  Str::uuid();
        $detailTiket['ticketId'] =  $validatedData['ticketId'];
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['statusDesc'] = auth()->user()->Employee->name. ' sent ticket (' . $validatedData['ticketNumber'] . ').';
        $detailTiket['statusDate'] = date('Y-m-d');
        $detailTiket['statusNote'] = $validatedData['requestDesc'];
        
        TicketDetail::Create($detailTiket);
        
        return redirect('/client/ticket')->with('success', 'Ticket data updated successfully');
    }

    public function detail(Ticket $ticket) {
        return view('client.ticket.detail', [
            'ticket'    => $ticket,
            'ticket_details' => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function validationDetail(Ticket $ticket) {
        return view('client.ticket.validationDetail', [
            'ticket'              => $ticket,
            'ticket_details'     => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get(),
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

        
        if ($ticketDetail['status'] == "Done") {
            $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' receive validation and ticket (' . $request->ticketNumber . ') done.';
        } else {
            $ticketDetail['statusDesc'] = auth()->user()->Employee->name. ' complain on the ticket (' . $request->ticketNumber . '), Please check again by a technician.';
        }

        TicketDetail::Create($ticketDetail);

        return redirect('/client/ticket')->with('success', 'Ticket data updated successfully');
    }

    public function message(Ticket $ticket) {

        $message =  Message::where('ticketId', $ticket->ticketId)->first();

        return view('client.ticket.message', [
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
