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
            // dd($id);

         if ($id==1) {
            $newdata= DB::select('CALL sp_queryAdminTree()');
            
         }else{
            $newdata= DB::select('CALL sp_consultararbol(?)', array(
                $id
            ));

            // dd(count($newdata));
         }

         
            $fhater=array(
                'idFhater'=>$id,
                'username'=>Auth()->user()->userName
            );

          
            array_push($newdata,$fhater);
         
             $datos = json_encode($newdata);
           

           
          
             return view('pages.partner-tree',['data'=> $datos]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
