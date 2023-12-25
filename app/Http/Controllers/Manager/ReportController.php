<?php

namespace App\Http\Controllers\Manager;

use App\Models\Ticket;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index() {
                
        return view('manager.report.index', [
            'tickets'    => Ticket::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function all() {
        $data = [
            'tickets' => Ticket::orderBy('created_at', 'desc')->get()
        ];

        $pdf = Pdf::loadView('manager.report.all', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('Report.pdf');
    }

    public function target(Request $request) {

        $data = [
            'tickets' => Ticket::whereDate('created_at', '>=', $request->fromDate)->whereDate('created_at', '<=', $request->untilDate)->orderBy('created_at', 'desc')->get(),
            'fromDate' => $request->fromDate,
            'untilDate' => $request->untilDate,
        ];

        $pdf = Pdf::loadView('manager.report.target', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('Report.pdf');
    }

    public function one(Ticket $ticket) {
        $data = [
            'ticket'             => $ticket,
            'ticket_details'      => TicketDetail::where('ticketId', $ticket->ticketId)->orderBy('created_at', 'desc')->get()
        ];

        $pdf = Pdf::loadView('manager.report.one', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('report.pdf');
    }
}
