<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class demandeController extends Controller
{
    static function index(){
        return view('user.demande');
    }
}
