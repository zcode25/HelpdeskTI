<?php

namespace App\Http\Controllers\Admin;
use App\Models\Ticket;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DashboardController extends Controller
{
    public function index() {

        $tickets = Ticket::select( DB::raw("DATE_FORMAT(created_at,'%d') AS date"), DB::raw('count(*) as total'))->whereMonth('created_at', date('m'))->groupBy('date')->orderBy('date', 'asc')->get();
        $status = Ticket::select( 'status', DB::raw('count(*) as total'))->groupBy('status')->orderBy('status', 'asc')->get();

        $label = [];
        $total = [];
        foreach($tickets as $ticket) {
            $label[] = $ticket->date;
            $total[] = $ticket->total;
        };

        $label2 = [];
        $total2 = [];
        foreach($status as $st) {
            $label2[] = $st->status;
            $total2[] = $st->total;
        };
        
        
        return view('admin.dashboard.index', [
            'label' => $label,
            'total' => $total,
            'label2' => $label2,
            'total2' => $total2,
        ]);

    }
}
