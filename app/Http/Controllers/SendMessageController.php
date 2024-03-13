<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Twilio\Rest\Client;

use Illuminate\Support\Str;

use App\Models\Ticket;



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



        // $imagenticket = "https://images.unsplash.com/photo-1431250620804-78b175d2fada?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1600&h=900&fit=crop&ixid=eyJhcHBfaWQiOjF9";



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


        return redirect()->route('tickets.index')->with($notification);;



    }

}

