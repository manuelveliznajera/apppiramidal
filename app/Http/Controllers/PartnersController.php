<?php

namespace App\Http\Controllers;

use App\Helper\Data;
use App\Models\Affiliate;
use App\Models\RelSponsor;
use App\Models\User;

use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        try {
            $id = Auth()->user()->idUser;
            $user = User::all();
            $relsponsor = RelSponsor::all();

            $pp = [];
            foreach ($relsponsor as  $value) {
                
                $us = Affiliate::where('idAffiliated', $value->idAffiliatedChild) ->first();
                $usuario = User::where('idAffiliated', $us->idAffiliated)->first();
                  
                if ($value->idRel==1) {  
                    $dat = [
                        'id' => $value->idAffiliatedChild,
                        'name' => $usuario->userName,
                        'email' => $us->Email,
                        'rank' => 'oro'
                    ];
                    array_push($pp, $dat);
                }else{
                    $dat = [
                        'id' => $value->idAffiliatedChild,
                        'pid'=>$value->idAffiliatedParent,
                        'name' =>$usuario->userName,
                        'email' => $us->Email,
                        'rank' => 'oro'
                    ];
                    array_push($pp, $dat);

                }
               

            }
            //  dd($pp);

            $data =  json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL TreeAff ('{$id}',5)")),true);


            $prueba = Data::getData();
            $datos = json_encode($pp);


            // dd($relsponsor);
            
            return view('pages.partner-tree',['data'=> $datos]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
