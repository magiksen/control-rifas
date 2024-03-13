<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Numero;
use App\Models\Participante;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;
use Illuminate\Support\Facades\DB;

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

        $image = Image::read('images/original.jpg');
        
       if($ticket->participante->cedula == NULL) {
           $cedula = "-";
       } else {
           $cedula = $ticket->participante->cedula;
       }

        $image->text($ticket->numero->numero, 600, 100, function (FontFactory $font) {
            $font->filename('fonts/sifonn-basic.otf');
            $font->color('#FFFFFF');
            $font->size(65);
            $font->align('center');
            $font->valign('middle');
        });
        $image->text($ticket->participante->nombre, 1400, 100, function (FontFactory $font) {
            $font->filename('fonts/sifonn-basic.otf');
            $font->color('#FFFFFF');
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
            $font->wrap(250);
        });
        $image->text($ticket->participante->apellido, 1400, 217, function (FontFactory $font) {
            $font->filename('fonts/sifonn-basic.otf');
            $font->color('#FFFFFF');
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
            $font->wrap(250);
        });
        $image->text($ticket->participante->telefono, 1400, 327, function (FontFactory $font) {
            $font->filename('fonts/sifonn-basic.otf');
            $font->color('#FFFFFF');
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
            $font->wrap(250);
        });
        $image->text($cedula, 1400, 427, function (FontFactory $font) {
            $font->filename('fonts/sifonn-basic.otf');
            $font->color('#FFFFFF');
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
            $font->wrap(250);
        });

        $ruta_imagen = 'images/'.$ticket->numero->numero.'-'.$ticket->participante->nombre.'-'.$ticket->participante->apellido.'.jpg';

        $image->save($ruta_imagen);

        $affected = DB::table('tickets')
              ->where('id', $ticket->id)
              ->update([
                'imagen' => $ruta_imagen,
            ]);

        $notification = array(
                'message' => 'Ticket creado correctamente',
                'alert-type' => 'success'
            );
        // return redirect()->route('tickets.index')->with('info', 'Ticket creado correctamente');
        return redirect()->route('ticket.show', ['id' => $ticket->id])->with($notification);
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
