<?php

namespace App\Http\Controllers;

use App\Helper\Data;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        try {

            $data = Data::getData();
            $user = json_encode($data);
            return view('pages.partner-tree',['user'=> $user]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
