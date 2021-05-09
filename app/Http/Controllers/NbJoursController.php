<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jours_restants;

class NbJoursController extends Controller
{
    static function showUser(){
        $data = jours_restants::all();
        foreach($data as $d){
            if($d->idEmploye==auth()->user()->id){
                $perso = $d;
                break;
            }
        }
        return view('user.index',['nbJours'=>$perso]);
    }
    static function showAdmin(){
        return view('admin.index');
    }
}
