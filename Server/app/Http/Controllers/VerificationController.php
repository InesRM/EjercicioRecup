<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verificateMail(Request $request) {
        $email = $request->email;
        $user = User::where('email', '=', $email)->first();
        $user->email_verified_at = now();
        $user->save();

        response()->json(["success"=>true, "message" => "Email verified correctly"],200);
        return redirect("http://localhost:8090/html/landing.html")->with('success', 'Email verified correctly');
    }
}
