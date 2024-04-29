<?php

namespace App\Http\Controllers;

use App\Models\Numero;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Has salido correctamente',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function index()
    {
        $pagados = Ticket::where('pago', '1')->count();
        $apartados = Ticket::whereNull('pago')->count();
        $libres = Numero::whereNull('ticket_id')->orWhere('ticket_id', 0)->count();
        $tomados = Numero::where('ticket_id', '>', 0)->count();

        $vendedores = DB::table('users')
            ->where('role_id', '=', 3)
            ->join('tickets', 'users.id', '=', 'tickets.user_id')
            ->select('users.name as nombre', 'users.id as id', DB::raw("count(tickets.user_id) as count"))
            ->groupBy('users.name', 'users.id')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        $vendedoresJSON = $vendedores->toJson();

        $participantes = DB::table('participantes')
            ->join('tickets', 'participantes.id', '=', 'tickets.participante_id')
            ->select('participantes.nombre as nombre', 'participantes.apellido as apellido', 'participantes.id as id', DB::raw("count(tickets.participante_id) as count"))
            ->groupBy('participantes.nombre', 'participantes.apellido', 'participantes.id')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        $participantesJSON = $participantes->toJson();

        return view('admin.index', ['pagados' => $pagados, 'apartados' => $apartados, 'libres' => $libres, 'tomados' => $tomados, 'vendedores' => $vendedoresJSON, 'participantes' => $participantesJSON]);
    }
}
