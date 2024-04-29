<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();



        if($user->hasExactRoles(['Vendedor'])){
            $participantes = Participante::where('user_id', $user->id)->get();
        } elseif ($user->hasExactRoles(['Vendedor|Admin'])) {
            $participantes = Participante::all();
        } elseif ($user->hasRole(['Admin|SuperAdmin'])) {
            $participantes = Participante::all();
        } else {
            $participantes = [];
        }

        return view('admin.participante.index', compact('participantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = DB::table('paises')->get();

        return view('admin.participante.create', ['paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
        ]);

        $participante = new Participante;
        $participante->nombre = $request->nombre;
        $participante->apellido = $request->apellido;
        $participante->cedula = $request->cedula;
        $participante->correo = $request->correo;
        $participante->telefono = $request->telefono;
        $participante->pais = $request->pais;
        $participante->user_id = $user->id;

        $participante->save();

        $allTicketsPaid = collect($participante->tickets)->every(function ($ticket) {
            return $ticket['pago'] == 1;
        });

        $notification = array(
            'message' => 'Participante creado correctamente',
            'alert-type' => 'success'
        );

        return view('admin.participante.show', ['participante' => $participante, 'allTicketsPaid' => $allTicketsPaid])->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $participante = Participante::where('id', $id)->first();

        $allTicketsPaid = collect($participante->tickets)->every(function ($ticket) {
            return $ticket['pago'] == 1;
        });

        return view('admin.participante.show', ['participante' => $participante, 'allTicketsPaid' => $allTicketsPaid]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $participante = Participante::where('id', $id)->first();

        $paises = DB::table('paises')->get();

        $pais_selected = DB::table('paises')
        ->where('pais_numero', '=', $participante->pais)
        ->first();

        return view('admin.participante.edit', ['participante' => $participante, 'paises' => $paises, 'pais_selected' => $pais_selected]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $affected = DB::table('participantes')
              ->where('id', $id)
              ->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => $request->cedula,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'pais' => $request->pais
            ]);

            $notification = array(
                'message' => 'Participante actualizado correctamente',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $participante = Participante::where('id', $id)->delete();

        $tickets = Ticket::where('participante_id', $id)->get();

        foreach($tickets as $ticket) {
            $affected = DB::table('numeros')
            ->where('id', $ticket->numero_id)
            ->update([
            'ticket_id' => '0',
            'participante_id' => '0',
            'user_id' => '0',
            ]);

            $ticket->delete();
        }

        $notification = array(
            'message' => 'Participante y sus tickets eliminados correctamente',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function pagoparticipante($id)
    {
            $affected = DB::table('tickets')
                ->where('participante_id', $id)
                ->update([
                    'pago' => 1,
                ]);

            $notification = array(
                'message' => 'Los tickets han sido pagados correctamente',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);
    }
}
