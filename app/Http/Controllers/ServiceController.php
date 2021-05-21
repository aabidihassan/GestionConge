<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conge;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    static function serviceDemandes(){
        $data = conge::join('users', 'conges.id_user', '=', 'users.id')
        ->where('id_service', '=', auth()->user()->id_service)
        ->where('chef_service', 1)
        ->get();

        return view('user.demandeservice', ['list'=>$data]);

    }
}
