<?php

namespace App\Http\Controllers;

use App\Models\conge;
use App\Models\User;
use App\Models\service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    static function serviceDemandes(){
        $data = conge::join('users', 'conges.id_user', '=', 'users.id')
        ->where('id_service', '=', auth()->user()->id_service)
        ->where('chef_service', 1)
        ->get();

        return view('user.demandeservice', ['list'=>$data]);

    }

    static function servicetAction(Request $req){
        conge::where('id', $req->idd)
        ->update(['chef_service' => $req->action]);

        if($req->action == 2){
            conge::where('id', $req->idd)
            ->update(['greffier_chef' => 1]);
            conge::where('id', $req->idd)
            ->update(['etat' => 3]);
        }
        else if($req->action == 5){
            conge::where('id', $req->idd)
            ->update(['etat' => 5]);
        }
    }

    static function getServices(){
        $data = service::all();
        return view('admin.employees', ['list'=>$data]);
    }

    static function getEmployees(Request $req){

        $data = User::join('conges', 'conges.id_user', '=', 'users.id')
        ->where('users.id_service', '=', $req->service)
        ->where('date_fin', '>', "2021-$req->mois-01")
        ->where('date_debut', '<', "2021-$req->mois-30")
        ->where('conges.etat', '=', '4')
        ->get();
        return response()->json(['lt'=>$data]);
    }

    static function getDemandes(){
        $data = conge::join('users', 'users.id', '=', 'conges.id_user')
        ->join('services', 'users.id_service', '=', 'services.id')
        ->where('conges.greffier_chef', '=', '1')
        ->get();
        return view('admin.demandes', ['list'=>$data]);
    }

    static function chefAction(Request $req){
        conge::where('id', $req->idd)
        ->update(['greffier_chef' => $req->action]);
        if($req->action == 2){
            conge::where('id', $req->idd)
            ->update(['etat' => 4]);
        }
        elseif($req->action == 5){
            conge::where('id', $req->idd)
            ->update(['etat' => 5]);
        }
    }
}
