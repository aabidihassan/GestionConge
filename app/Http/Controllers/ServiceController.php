<?php

namespace App\Http\Controllers;

use App\Models\conge;
use App\Models\User;
use App\Models\service;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    static function serviceDemandes(){
        $data = conge::join('users', 'conges.id_user', '=', 'users.id')
        ->where('id_service', '=', auth()->user()->id_service)
        ->where('chef_service', 1)
        ->get(['users.name', 'conges.*']);

        $dd = User::join('conges', 'conges.id_adjoint', '=', 'users.id')
        ->where('id_service', '=', auth()->user()->id_service)
        ->where('chef_service', 1)
        ->get('users.name AS ad');

        return view('user.demandeservice', ['list'=>$data, 'lt'=>$dd]);

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

    static function Services(){
        $data = service::all();
        return view('admin.employees', ['list'=>$data]);
    }

    static function accuile(){
        $data = service::all();
        return view('admin.index', ['list'=>$data]);
    }

    static function liste(){
        $data = User::where('type', '!=', 'admin')->get();
        return view('admin.presence', ['liste'=>$data]);
    }

    static function employees(Request $req){
        $data = User::join('services', 'services.id', '=', 'users.id_service')
        ->where('users.id_service', '=', $req->service)
        ->get(['users.id AS id_user', 'users.type', 'services.*', 'users.name']);
        return response()->json(['lt'=>$data]);
    }

    static function changeService(Request $req){
        User::where('id', $req->idEmp)
        ->update(['id_service' => $req->services]);
        return response()->json(['bool'=>true],200);
    }

    static function getEmployees(Request $req){

        $data = User::join('conges', 'conges.id_user', '=', 'users.id')
        ->where('users.id_service', '=', $req->service)
        ->where('date_fin', '>', "2021-$req->mois-01")
        ->where('date_debut', '<', "2021-$req->mois-31")
        ->where('conges.etat', '=', '4')
        ->get(['users.name', 'conges.*']);

        $min = service::where('id', $req->service)->get('services.minim');

        $how = User::where('id_service', '=', $req->service)->count();

        $dd = User::join('conges', 'conges.id_adjoint', '=', 'users.id')
        ->where('id_service', '=', $req->service)
        ->where('date_fin', '>', "2021-$req->mois-01")
        ->where('date_debut', '<', "2021-$req->mois-31")
        ->where('conges.etat', 4)
        ->get('users.name AS ad');

        return response()->json(['lt'=>$data, 'nb'=>$how, 'min'=>$min[0], 'list'=>$dd]);
    }

    static function getDemandes(){
        $data = conge::join('users', 'users.id', '=', 'conges.id_user')
        ->join('services', 'users.id_service', '=', 'services.id')
        ->where('conges.greffier_chef', '=', '1')
        ->get(['users.name', 'conges.*', 'services.nom']);

        $dd = User::join('conges', 'conges.id_adjoint', '=', 'users.id')
        ->where('conges.greffier_chef', 1)
        ->get('users.name AS ad');
        return view('admin.demandes', ['list'=>$data, 'lt'=>$dd]);
    }

    static function chefAction(Request $req){
        conge::where('id', $req->idd)
        ->update(['greffier_chef' => $req->action]);
        if($req->action == 2){
            conge::join('users', 'conges.id_user', '=', 'users.id')
            ->where('conges.id', $req->idd)
            ->update(['conges.etat' => 4, 'users.etat' => 2]);
        }
        elseif($req->action == 5){
            conge::where('id', $req->idd)
            ->update(['etat' => 5]);
        }
    }
    static function download(){
        $data = User::all();
        $pdf = PDF::loadView('admin.presence', ['liste'=>$data]);
        $pdf->autoScriptToLang = true;
        $pdf->autoArabic = true;
        $pdf->autoLangToFont = true;
        return $pdf->download('presence.pdf');
    }

    static function pass(){
        $data = service::all();
        return view('user.password', ['list'=>$data]);
    }

    static function changePass(Request $req){
        $pass = Hash::make($req->pass);
        User::where('id', $req->idEmp)
        ->update(['password' => $pass]);
        return response()->json(['bool'=>true],200);
    }
}
