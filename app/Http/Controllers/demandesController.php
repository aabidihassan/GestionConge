<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conge;
use App\Models\referance;
use App\Models\vacance;
use App\Models\User;

class demandesController extends Controller
{
    static function indexChef(){
        return view('admin.index');
    }

    static function listUsers(){
        $data = User::where('id_service', auth()->user()->id_service)->where('id', '!=', auth()->user()->id)->get();
        return view('user.demande', ['list'=>$data]);
        //return response()->json(['list'=>$data]);
    }

    static function indexUser(){
        $data = conge::where('id_user', auth()->user()->id)
        ->where('etat','4')
        ->get();
        $a2021 = 0;
        foreach($data as $row){
            switch ($row->annee){
                case 2021: $a2021+= $row->nbJours; break;
            }
        }
        $list = conge::where('id_user', auth()->user()->id)->get();

        return view('user.index', ['a2021'=>$a2021, 'list'=>$list]);
    }

    static function remplacement(){
        $data = conge::join('users', 'users.id', '=', 'conges.id_user')
        ->where('id_adjoint', auth()->user()->id)->where('adjoint', 1)->get();
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
        $how = conge::where('id_user', auth()->user()->id)
        ->where('annee', $annee)
        ->where('etat','4')
        ->get();

        $vacance = vacance::where('date','<=' ,"$req->jusqua")->where('date','>=' ,"$req->de")->get();

        //$vacance = vacance::whereBetween('nbJours', [$req->de , $req->jusqua])->get();

        foreach($vacance as $row){
            $day = date('D', strtotime($row->date));
            if($day == "Sat" || $day == "Sun"){
                break;
            }
            $d-=$row->nbJours;
        }
        
        $consom = 0;

        foreach($how as $row){
            $consom = $consom + $row->nbJours;
        }

        if($consom + $d <= 22 || $req->type ==2){
            
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
            if(auth()->user()->id_service==2 || auth()->user()->id_service==6 || auth()->user()->type=="chef"){
                $conge->adjoint = 2;
                $conge->chef_service = 2;
                $conge->etat = 3;
            }else{
                $conge->adjoint = 1;
                $conge->chef_service = 0;
                $conge->etat = 1;
            }
            
            $conge->greffier_chef = 0;
            
            $conge->save();

            referance::where('annee', $annee)
            ->update(['lastNum' => $data[0]->lastNum+1]);

            return response()->json(['bool'=>true],200);
        }

        return response()->json(['error' => 'Error'], 500);
    }

    static function adjointAction(Request $req){
            conge::where('id', $req->idd)
            ->update(['adjoint' => $req->action]);
            if($req->action == 2){
                conge::where('id', $req->idd)
            ->update(['chef_service' => 1]);
            conge::where('id', $req->idd)
            ->update(['etat' => 2]);
            }
            elseif($req->action == 5){
                conge::where('id', $req->idd)
                ->update(['etat' => 5]);
            }
            $data = conge::where('id_adjoint', auth()->user()->id)->where('adjoint', 1)->get();
            Redirect::to('/demandes');
    }

}
?>