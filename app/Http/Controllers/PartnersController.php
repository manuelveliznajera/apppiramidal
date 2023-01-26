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
            
            $data =  json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL TreeAff ('{$id}',5)")),true);

            $datos = json_encode($data);


        
            
            return view('pages.partner-tree',['data'=> $datos]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
