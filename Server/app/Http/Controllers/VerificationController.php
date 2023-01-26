<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verificateMail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', '=', $email)->first();
        $user->email_verified_at = now();
        $user->save();

        return view('Bienvenido')->with(['success' => true, 'Email verified correctly'], 200);

    }
}
