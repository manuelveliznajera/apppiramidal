<?php

namespace App\Http\Controllers;

use App\Helper\Data;
use App\Models\Affiliate;
use App\Models\Arbol;
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
                $Email= DB::table('affiliates')
                ->select('Email')->where('idAffiliated',$id)
                ->get();
                // dd($Email[0]);
                $newdata=array();
                $fhater[]=array(
                    'idFhater'=>$id,
                    'Email'=>$Email[0],
                    'username'=>Auth()->user()->userName,

                );
                if ($id==1) {
                    
                    $query= DB::select('CALL sp_queryAdminTree()');
                    
                }else{
                    $query= DB::select('CALL sp_consultararbol(?)', array(
                        $id
                    ));

             
                   
                }
                $newdata=array_merge($fhater, $query);
         
                $datos = json_encode($newdata);
                
                // dd($datos);
             return view('pages.partner-tree',['data'=> $datos]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
