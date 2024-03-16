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
use Intervention\Image\Geometry\Factories\RectangleFactory;

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
        $ticket->pago = $request->pago;

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
    public function destroy($id)
    {
        $ticket = Ticket::where('id', $id)->first();

        $affected = DB::table('numeros')
        ->where('id', $ticket->numero_id)
        ->update([
          'ticket_id' => '0',
          'participante_id' => '0',
          'vendedor_id' => '0',
        ]);

        $ticket->delete();

        $notification = array(
            'message' => 'Ticket eliminado correctamente',
            'alert-type' => 'success'
        );

        return Redirect()->route('tickets.index')->with($notification);
    }

    public function pago($id) 
    {
            $affected = DB::table('tickets')
                ->where('id', $id)
                ->update([
                    'pago' => 1,
                ]);
            
            $notification = array(
                'message' => 'El ticket ha sido pagado correctamente',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);
    }

    public function multiplecreate(?string $numero = null)
    {
        $participantes = Participante::all();
        $vendedores = Vendedor::all();
        $numeros = Numero::query()->orderBy('numero', 'asc')->get();

        return view('admin.ticket.multiple', compact('participantes', 'vendedores', 'numeros'));
    }

    public function multiplestore(Request $request)
    {
        //dd($request->numeros);
        foreach ($request->numeros as $numero) {
            $ticket = new Ticket;
            $ticket->participante_id = $request->participante;
            $ticket->vendedor_id = $request->vendedor;
            $ticket->numero_id = $numero;
            $ticket->pago = $request->pago;
    
            $ticket->save();

            $numerito = Numero::find($numero);
            $numerito->ticket_id = $ticket->id;
            $numerito->participante_id = $request->participante;
            $numerito->vendedor_id = $request->vendedor;

            $numerito->save();

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
            $font->wrap(300);
        });
        $image->text($ticket->participante->apellido, 1400, 217, function (FontFactory $font) {
            $font->filename('fonts/sifonn-basic.otf');
            $font->color('#FFFFFF');
            $font->size(40);
            $font->align('center');
            $font->valign('middle');
            $font->lineHeight(1.6);
            $font->wrap(300);
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

        }

        $notification = array(
            'message' => 'Tickets creados correctamente',
            'alert-type' => 'success'
        );

        return redirect()->route('participante.show', ['id' => $ticket->participante_id])->with($notification);
    }

    public function reimagines() {

        $tickets = Ticket::all();
        //dd($tickets);
        

        foreach($tickets as $ticket) {
             $image = Image::read('images/original.jpg');

             $image->text($ticket->numero->numero ?? "-", 600, 100, function (FontFactory $font) {
                 $font->filename('fonts/sifonn-basic.otf');
                 $font->color('#FFFFFF');
                 $font->size(65);
                 $font->align('center');
                 $font->valign('middle');
             });
             $image->text($ticket->participante->nombre ?? "-", 1400, 100, function (FontFactory $font) {
                 $font->filename('fonts/sifonn-basic.otf');
                 $font->color('#FFFFFF');
                 $font->size(40);
                 $font->align('center');
                 $font->valign('middle');
                 $font->lineHeight(1.6);
                 $font->wrap(300);
             });
             $image->text($ticket->participante->apellido ?? "-", 1400, 217, function (FontFactory $font) {
                 $font->filename('fonts/sifonn-basic.otf');
                 $font->color('#FFFFFF');
                 $font->size(40);
                 $font->align('center');
                 $font->valign('middle');
                 $font->lineHeight(1.6);
                 $font->wrap(300);
             });
             $image->text($ticket->participante->telefono ?? "-", 1400, 327, function (FontFactory $font) {
                 $font->filename('fonts/sifonn-basic.otf');
                 $font->color('#FFFFFF');
                 $font->size(40);
                 $font->align('center');
                 $font->valign('middle');
                 $font->lineHeight(1.6);
                 $font->wrap(250);
             });
             $image->text($ticket->participante->cedula ?? "-", 1400, 427, function (FontFactory $font) {
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
        }
        
         $notification = array(
                 'message' => 'Imagenes recreadas correctamente',
                 'alert-type' => 'success'
             );

         return redirect()->route('tickets.index')->with($notification);
    }

    public function cuadrocontrol() {
        $numeros = Numero::query()->orderBy('numero', 'asc')->get();
        

        $image = Image::read('images/cuadrocontrol.jpg');

        $columna = 325;
        $filacuadro = 0;
        $filatexto = 0;

        foreach( $numeros->chunk(31) as $grupo ) {
            foreach( $grupo as $numero) {
                if($numero->ticket_id > 0) {
                    $image->drawRectangle($columna, $filacuadro, function (RectangleFactory $rectangle) {
                        $rectangle->size(65, 50); // width & height of rectangle
                        $rectangle->background('#fdd5dd'); // background color of rectangle
                        $rectangle->border('#fbc1cb', 1); // border color & size of rectangle
                    });
                    $image->text($numero->numero, $columna+3, $filatexto+7, function (FontFactory $font) {
                        $font->filename('fonts/calibri-regular.ttf');
                        $font->color('#921c32');
                        $font->size(16);
                        $font->align('left');
                        $font->valign('middle');
                    });
                }else {
                    $image->drawRectangle($columna, $filacuadro, function (RectangleFactory $rectangle) {
                        $rectangle->size(65, 50); // width & height of rectangle
                        $rectangle->background('#cceaed'); // background color of rectangle
                        $rectangle->border('#b3e0e5', 1); // border color & size of rectangle
                    });
                    $image->text($numero->numero, $columna+3, $filatexto+7, function (FontFactory $font) {
                        $font->filename('fonts/calibri-regular.ttf');
                        $font->color('#005b64');
                        $font->size(16);
                        $font->align('left');
                        $font->valign('middle');
                    });
                }

                $columna = $columna + 30;
            }
            $columna = 325;
            $filacuadro = $filacuadro + 22;
            $filatexto = $filatexto + 22;
        }

        $ruta_imagen = 'images/controlactual.jpg';
     
        $image->save($ruta_imagen);

        $notification = array(
            'message' => 'Imagen de control creada correctamente',
            'alert-type' => 'success'
        );
        return redirect()->route('tickets.index')->with($notification);
    }
}
