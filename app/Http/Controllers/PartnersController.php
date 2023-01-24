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

            //conectar a esta tabla con id del loqueado para traer todo sus hijos y nietos

            // $data = Data::getData();
            // $id=Auth()->user()->idUser;
            // $data =[ 'id'=>$id] ;
            $datas = RelSponsor::all();
            foreach ($datas as $value) {
                //dd($value);
            }

            //dd($datas);
            $data = [];

            $user = json_encode($data);
            
            return view('pages.partner-tree',['user'=> $user]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
