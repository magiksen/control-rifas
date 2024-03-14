<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Participante;
use App\Models\Vendedor;
use App\Models\Numero;

class ReporteController extends Controller
{
    public function reportetickets() {
        $pagados = Ticket::where('pago', '1')->count();
        $apartados = Ticket::whereNull('pago')->count();
        $libres = Numero::whereNull('ticket_id')->orWhere('ticket_id', 0)->count();
        $tomados = Numero::where('ticket_id', '>', 0)->count();

        return view('admin.reportes.tickets', ['pagados' => $pagados, 'apartados' => $apartados, 'libres' => $libres, 'tomados' => $tomados]);

    }
}
