<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conge;
use App\Models\referance;

class demandesController extends Controller
{
    static function indexAdmin(){

    }
    static function indexUser(){
        $data = demande::where('idEmploye', auth()->user()->id)->get();
        return view('user.demandes',['list'=>$data]);
    }

    static function remplacement(){
        $data = conge::where('id_adjoint', auth()->user()->id)->where('adjoint', 0)->get();
        return view('user.demandes',['list'=>$data]);
    }

    static function insertDemande(Request $req){
        $annee = $req->annee;

        $nbJour = 0;

        $d1 = strtotime($req->de);

        $d2 = strtotime($req->jusqua);

        $d = $d2 - $d1;
        $d = $d/(86400)+1;

        for ( $i = $d1; $i <= $d2; $i = $i + 86400 ) {
            $day = date('D', $i);
            if($day == "Sat" || $day == "Sun"){
                $d--;
            }
          }
        $how = conge::where('id_user', auth()->user()->id)->where('annee', $annee)->get();
        
        $consom = 0;

        foreach($how as $row){
            $consom = $consom + $row->nbJours;
        }

        if($consom + $d <= 22){
            
            $data = referance::where('annee', $annee)->get();

            $conge = new conge;
            $conge->id = 0;
            $conge->id_user = auth()->user()->id;
            $conge->id_adjoint = $req->adjoint;
            $conge->referance = $data[0]->referance."/".$data[0]->lastNum;
            $conge->type_vac = $req->type;
            $conge->annee = $req->annee;
            $conge->date_debut = $req->de;
            $conge->date_fin = $req->jusqua;
            $conge->nbJours = $d;
            $conge->adjoint = 0;
            $conge->chef_service = 0;
            $conge->greffier_chef = 0;
            $conge->etat = 0;
            $conge->save();

            referance::where('annee', $annee)
            ->update(['lastNum' => $data[0]->lastNum+1]);

            return response()->json(['bool'=>true]);
        }

        return response()->json(['error' => 'Error'], 500);
    }

    static function adjointAction(Request $req){
            conge::where('id', $req->idd)
            ->update(['adjoint' => $req->action]);
            return response()->json(['bool'=>true]);
    }

}
?>