<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Numero;
use App\Models\Participante;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        $numeros = Numero::query()->orderBy('numero', 'asc')->get();

        return view('admin.ticket.index', compact('tickets', 'numeros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(?string $numero = null)
    {
        $participantes = Participante::all();
        $vendedores = Vendedor::all();
        $numeros = Numero::query()->orderBy('numero', 'asc')->get();
        $numero_solo = Numero::where('numero', $numero)->first();
        return view('admin.ticket.create', compact('participantes', 'vendedores', 'numeros', 'numero_solo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $ticket = new Ticket;
        $ticket->participante_id = $request->participante;
        $ticket->vendedor_id = $request->vendedor;
        $ticket->numero_id = $request->numero;

        $ticket->save();

        $numero = Numero::find($request->numero);
        $numero->ticket_id = $ticket->id;
        $numero->participante_id = $request->participante;
        $numero->vendedor_id = $request->vendedor;

        $numero->save();

        return view('admin.ticket.index')->with('info', 'Ticket creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->first();

        return view('admin.ticket.show', ['ticket' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
