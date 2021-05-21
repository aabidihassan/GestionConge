<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conge;
use App\Models\referance;
use App\Models\vacance;

class demandesController extends Controller
{
    static function indexChef(){
        return view('admin.index');
    }
    static function indexUser(){
        $data = conge::where('id_user', auth()->user()->id)->get();
        $a2020 = $a2021 = $a2019 = 0;
        foreach($data as $row){
            switch ($row->annee){
                case 2020: $a2020+= $row->nbJours; break;
                case 2021: $a2021+= $row->nbJours; break;
                case 2019: $a2019+= $row->nbJours; break;
            }
        }
        $list = conge::where('id_user', auth()->user()->id)->get();

        return view('user.index', ['a2019'=>$a2019, 'a2020'=>$a2020, 'a2021'=>$a2021, 'list'=>$list]);
    }

    static function remplacement(){
        $data = conge::where('id_adjoint', auth()->user()->id)->where('adjoint', 1)->get();
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
            $conge->adjoint = 1;
            $conge->chef_service = 0;
            $conge->greffier_chef = 0;
            $conge->etat = 1;
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
            //return response()->json(['bool'=>true]);
            $data = conge::where('id_adjoint', auth()->user()->id)->where('adjoint', 1)->get();
            Redirect::to('/demandes');
    }

}
?>