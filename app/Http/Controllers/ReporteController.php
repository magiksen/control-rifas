<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Participante;
use App\Models\Vendedor;
use App\Models\Numero;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function reportetickets() {
        $pagados = Ticket::where('pago', '1')->count();
        $apartados = Ticket::whereNull('pago')->count();
        $libres = Numero::whereNull('ticket_id')->orWhere('ticket_id', 0)->count();
        $tomados = Numero::where('ticket_id', '>', 0)->count();

        return view('admin.reportes.tickets', ['pagados' => $pagados, 'apartados' => $apartados, 'libres' => $libres, 'tomados' => $tomados]);

    }

    public function reporteparticipantes() {
        //$participantes = Participante::all();

        $participantes = DB::table('participantes')
        ->join('tickets', 'participantes.id', '=', 'tickets.participante_id')
        ->select('participantes.nombre as nombre', 'participantes.apellido as apellido', DB::raw("count(tickets.participante_id) as count"))
        ->groupBy('participantes.nombre', 'participantes.apellido')
        ->orderBy('count', 'desc')
        ->get();

        return view('admin.reportes.participantes', ['participantes' => $participantes]);
    }
}
