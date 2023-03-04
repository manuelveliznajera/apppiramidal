<?php

namespace App\Http\Controllers;

use App\Helper\Data;
use App\Models\Affiliate;
use App\Models\RelSponsor;
use App\Models\User;
use DB;

use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        try {
            $id = Auth()->user()->idUser;

           $newdata= DB::select('CALL sp_consultararbol(?)', array(
                $id
                // Convertir a nulo si es una cadena vacía
            ));
            // dd($newdata);
            $user = User::all();
            $relsponsor = RelSponsor::all();

            $pp = [];
            $dat = [
                'id' => $id,
                'name' => Auth()->user()->userName,
                'rank' => 'oro'
            ];
            array_push($pp, $dat);
            foreach ($newdata as  $value) {
                
                    $dat = [
                        'id' => $value->idAffiliated,
                        'pid'=>$id,
                        'name' =>$value->userName,
                        'rank' => 'oro'
                    ];
                    array_push($pp, $dat);

                }
               

            
            //  dd($pp);

            // $data =  json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL TreeAff ('{$id}',5)")),true);


            // $prueba = Data::getData();
            $datos = json_encode($pp);


            // dd($relsponsor);
            
            return view('pages.partner-tree',['data'=> $datos]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
