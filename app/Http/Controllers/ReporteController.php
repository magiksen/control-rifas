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

        $participantes = DB::table('participantes')
        ->join('tickets', 'participantes.id', '=', 'tickets.participante_id')
        ->select('participantes.nombre as nombre', 'participantes.apellido as apellido', 'participantes.id as id', DB::raw("count(tickets.participante_id) as count"))
        ->groupBy('participantes.nombre', 'participantes.apellido', 'participantes.id')
        ->orderBy('count', 'desc')
        ->get();

        return view('admin.reportes.participantes', ['participantes' => $participantes]);
    }

    public function reportevendedores() {

        $vendedores = DB::table('users')
        ->where('role_id', '=', 3)
        ->join('tickets', 'users.id', '=', 'tickets.user_id')
        ->select('users.name as nombre', 'users.id as id', DB::raw("count(tickets.user_id) as count"))
        ->groupBy('users.name', 'users.id')
        ->orderBy('count', 'desc')
        ->get();

        return view('admin.reportes.vendedores', ['vendedores' => $vendedores]);
    }

    public function show($slug) {

        if ($slug == 'apartados') {
            $data = Ticket::whereNull('pago')->get();
        } else if ($slug == 'libres') {
            $data = Numero::whereNull('ticket_id')->orWhere('ticket_id', 0)->get();
        } else if ($slug == 'pagados') {
            $data = Ticket::where('pago', '1')->get();
        }

        return view('admin.reportes.show', ['data' => $data, 'slug' => $slug]);
    }
}
