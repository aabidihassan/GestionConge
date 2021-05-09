<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\demande;
use App\Models\referance;

class demandesController extends Controller
{
    static function indexAdmin(){

    }
    static function indexUser(){
        $data = demande::where('idEmploye', auth()->user()->id)->get();
        return view('user.demandes',['list'=>$data]);
    }

    static function insertDemande(Request $req){
        $annee = $req->annee;
        $data = referance::where('annee', $annee)->get();
        referance::where('annee', $annee)
          ->update(['lastNum' => $data[0]->lastNum+1]);

        $demande = new demande;
        $demande->id = 0;
        $demande->idEmploye = auth()->user()->id;
        $demande->type = $req->type;
        $demande->de = $req->de;
        $demande->jusqua = $req->jusqua;
        $demande->adjoint = $req->adjoint;
        $demande->referance = $data[0]->referance."/".$data[0]->lastNum;
        $demande->save();

        //$data = demandes::where('idEmploye', auth()->user()->id)->get();


        // \DB::table('demande')->insert([
        //     'id' => 0,
        //     'idEmploye' => auth()->user()->id,
        //     'type' => $req->type,
        //     'de' => $req->de,
        //     'jusqua' => $req->jusqua,
        //     'adjoint' => $req->adjoint
        // ]); 


        return response()->json(['bool'=>true]);
    }
}
