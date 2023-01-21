<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationMail extends Controller{
    static public function sendMail($email, $userName){
        $data = [
            'userName' => $userName,
            'email' => $email,
        ];

        //Le mando la vista 'welcome' como cuerpo del correo.
        Mail::send('correo', $data, function($message) use ($email)
        {
            $message->to($email)->subject('Activar Cuenta');
            $message->from('asir201920200@gmail.com', 'Ines');
        });

        return response()->json(["enviado" => true, "mensaje"=>"Enviado"],200);
    }
}
