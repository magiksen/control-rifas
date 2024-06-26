<?php



namespace App\Http\Controllers;



use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\Participante;
use Illuminate\Support\Facades\DB;


class SendMessageController extends Controller

{

    /**

     * Send Whatsapp message to number phone.

     */

    public function sendmessage($id) {

        $ticket = Ticket::where('id', $id)->first();
        $numerotelf = $ticket->participante->telefono;
        // $numerotelf = Str::of($numerotelf)->substr(1);
        $numeropais = $ticket->participante->pais;
        $imagenticket = $ticket->imagen;
        //$imagenticket = "https://images.unsplash.com/photo-1431250620804-78b175d2fada?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1600&h=900&fit=crop&ixid=eyJhcHBfaWQiOjF9";


        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $contentSid = getenv("TWILIO_CONTENT_SID");
        $messagingServiceSid = getenv("TWILIO_MESSAGING_SERVICE_SID");
        $message = "Gracias por participar en la Gran Rifa, este es su ticket de participacion";
        $recipient = "whatsapp:+".$numeropais.$numerotelf;

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipient, array(

            'contentSid' => $contentSid,

            'from' => $messagingServiceSid,

            'contentVariables' => json_encode([

                "1" => $imagenticket,

            ]),

        ));

        $notification = array(
            'message' => 'El ticket se ha enviado correctamente',
            'alert-type' => 'success'
        );


        return redirect()->route('tickets.index')->with($notification);
    }

    public function sendmultiple($id) {

        $participante = Participante::where('id', $id)->first();

        $affected = DB::table('tickets')
                ->where('participante_id', $participante->id)
                ->update([
                    'pago' => 1,
                ]);

        //dd($participante->tickets);

        foreach ($participante->tickets as $ticket) {

        $numerotelf = $ticket->participante->telefono;
        // $numerotelf = Str::of($numerotelf)->substr(1);
        $numeropais = $ticket->participante->pais;

        $imagenticket = $ticket->imagen;
        //$imagenticket = "images/original.jpg";
        //$imagenticket = "https://images.unsplash.com/photo-1431250620804-78b175d2fada?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1600&h=900&fit=crop&ixid=eyJhcHBfaWQiOjF9";

        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');

        $account_sid = getenv("TWILIO_SID");

        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $contentSid = getenv("TWILIO_CONTENT_SID");

        $messagingServiceSid = getenv("TWILIO_MESSAGING_SERVICE_SID");

        $message = "Gracias por participar en la Gran Rifa, este es su ticket de participacion";

        $recipient = "whatsapp:+".$numeropais.$numerotelf;


        $client = new Client($account_sid, $auth_token);

        $client->messages->create($recipient, array(

            'contentSid' => $contentSid,

            'from' => $messagingServiceSid,

            'contentVariables' => json_encode([

                "1" => $imagenticket,

            ]),

        ));
        }

        $notification = array(
            'message' => 'Los tickets han sido pagados y enviados correctamente',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }

    public function sendvendedor($id) {
        $vendedor = User::where('id', $id)->first();

        foreach ($vendedor->tickets as $ticket) {

            $affected = DB::table('tickets')
                ->where('participante_id', $ticket->participante->id)
                ->update([
                    'pago' => 1,
                ]);

            // ENVIAR WS

            $numerotelf = $ticket->participante->telefono;
            $numeropais = $ticket->participante->pais;
            $imagenticket = $ticket->imagen;

            $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');

            $account_sid = getenv("TWILIO_SID");

            $auth_token = getenv("TWILIO_AUTH_TOKEN");

            $contentSid = getenv("TWILIO_CONTENT_SID");

            $messagingServiceSid = getenv("TWILIO_MESSAGING_SERVICE_SID");

            $message = "Gracias por participar en la Gran Rifa, este es su ticket de participacion";

            $recipient = "whatsapp:+".$numeropais.$numerotelf;


            $client = new Client($account_sid, $auth_token);

            $client->messages->create($recipient, array(

                'contentSid' => $contentSid,

                'from' => $messagingServiceSid,

                'contentVariables' => json_encode([

                    "1" => $imagenticket,

                ]),

            ));
        }

        $notification = array(
            'message' => 'Los tickets del vendedor han sido pagados y enviados correctamente',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);

    }

}

