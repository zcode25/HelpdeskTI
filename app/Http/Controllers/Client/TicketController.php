<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketDetail;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TicketController extends Controller
{
    public function index() {
        return view('client.ticket.index', [
            'tickets'    => Ticket::all()
        ]);
    }

    public function create() {
        return view('client.ticket.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'ticketDate'     => 'required',
            'request'        => 'required',
            'requestDesc'    => 'required',
            'requestPict'    => 'required|mimes:png,jpg|max:2048',
            'categoryId'    => 'required',
        ]);
        
        $validatedData['ticketId'] = Str::uuid();
        $validatedData['clientId'] = auth()->user()->userId;
        $validatedData['ticketNumber'] = IdGenerator::generate(['table' => 'tickets', 'field' => 'ticketNumber', 'length' => 23, 'prefix' => 'HES/IT/WO/' . date('d/m/y/')]);
        $validatedData['status'] = 'Sent';
        
        if($request->file('requestPict')) {
            $validatedData['requestPict'] = $request->file('requestPict')->store('requestPict');
        }
        
        Ticket::create($validatedData);

        $detailTiket['ticketDetailId'] =  Str::uuid();
        $detailTiket['ticketId'] =  $validatedData['ticketId'];
        $detailTiket['status'] = $validatedData['status'];
        $detailTiket['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' mengirim tiket (' . $validatedData['ticketNumber'] . ').';
        $detailTiket['statusDate'] = date('Y-m-d');
        $detailTiket['statusNote'] = $validatedData['requestDesc'];
        
        TicketDetail::Create($detailTiket);
        
        return redirect('/client/ticket')->with('success', 'Ticket updated successfully');
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
        ]);


        Ticket::where('ticketId', $ticket->ticketId)->update($validatedData);

        $ticketDetail['ticketDetailId'] =  Str::uuid();
        $ticketDetail['ticketId'] =  $ticket->ticketId;
        $ticketDetail['status'] = $validatedData['status'];
        $ticketDetail['statusNote'] = $request->statusNote;
        $ticketDetail['statusDate'] = date('Y-m-d');

        
        if ($ticketDetail['status'] == "Selesai") {
            $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' menerima validasi dan tiket (' . $request->ticketNumber . ') selesai.';
        } else {
            $ticketDetail['statusDesc'] = 'Sdr. '. auth()->user()->Employee->name. ' komplain pada tiket (' . $request->ticketNumber . '), Mohon untuk dicek kembali oleh teknisi.';
        }

        TicketDetail::Create($ticketDetail);

        return redirect('/client/ticket')->with('success', 'Data ticket berhasil diperbaruhi');
    }
}
