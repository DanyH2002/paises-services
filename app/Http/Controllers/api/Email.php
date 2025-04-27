<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class Email extends Controller
{
    // Enviar correo de confirmación
    public function sendEmail($to, $subject, $body)
    {
        if (!is_array($to)) {
            $to = [$to];
        }
        Mail::raw($body, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }
}
