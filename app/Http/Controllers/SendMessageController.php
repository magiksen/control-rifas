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
        $numerotelf = Str::of($numerotelf)->substr(1);


        // $imagenticket = asset($ticket->imagen);

        $imagenticket = "https://images.unsplash.com/photo-1431250620804-78b175d2fada?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1600&h=900&fit=crop&ixid=eyJhcHBfaWQiOjF9";

        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $message = "Gracias por participar en el sorte, aca esta su ticket";
        $recipient = "whatsapp:+58".$numerotelf;


        $client = new Client($account_sid, $auth_token);
        return $client->messages->create($recipient, array('mediaUrl' => $imagenticket, 'from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));

    }
}
