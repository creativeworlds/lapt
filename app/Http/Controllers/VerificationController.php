<?php

namespace App\Http\Controllers;

use App\Support\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $req)
    {
        $fileName = Verification::decode($req->code);
        return view('verification', compact('fileName'));
    }
}