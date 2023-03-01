<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\RelSponsor;
use App\Models\User;

use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SocioActivo extends Component
{
  

    public $pais;
    public $fechaingreso;
    public $terminos = false;
    public $lenguaje='english';
    public $invitedby;
    public $SSN='';
    public $Name='';
    public $LastName='';
    public $AlternativePhone;
    public $Workphone='000000000';
    public $DateBirth;
    public $Email='';
    
    public $confirmEmail='';
    public $Address='';
    public $Country='';
    public $State='';
    public $City='';
    public $ZipCode='';
    public $WorkPhone='00000000';
    public $Latitude;
    public $Longitude;
    public $userName='';
    public $Password='Besanabg2023';
    public $confirmPassword='Besanabg2023';
    public array $data;
    public $message='';
    public $confirmation_code;
    public $password_confirmation;
public $asignarSocio=false;
public $webseries = [];    
    public function mount(String $id='besana'){
        $this->invitedby = $id;
        $this->lenguaje='spanish';
       
       
    }

    public function render()
    {
        $this->webseries=RelSponsor::where('idAffiliatedParent',Auth()->user()->idAffiliated)->get();
        dd($this->webseries);
        return view('livewire.socio-activo')
        ->extends('layout.basenew')
                ->section('subcontent');
    }
    protected $rules=[
        'SSN' => 'required|unique:affiliates',
        'fechaingreso'=>'required',
        'invitedby'=>'required',
        'Email' => 'required|unique:affiliates',
        'confirmEmail' => 'required|same:Email', 
        'userName'=>'required|unique:users',  
        'Name'=>'required|string',
        'LastName'=>'required|string',
        'AlternativePhone'=>'required|string',
        'WorkPhone'=>'required',
        'DateBirth'=>'required|string',    
        'Address'=>'required|string',
        'Country'=>'required|string',
        'State'=>'required|string',
        'City'=>'required|string',
        'ZipCode'=>'required|string',  
        'Password'=>'required',
        'password_confirmation' => 'required|same:Password'
    ];

    protected $messages = [
        'SSN.unique' => 'El id ya esta en uso',
        'userName.unique'=>'El usuario ya esta en uso',
        'password_confirmation.same'=>'las contraseñas no coinciden',
        'Email.unique'=>'El Correo ya esta en uso',
        'confirmEmail.same'=>'Los correos no coinciden',
        
    ];
    public function create(){
        
       $confirmation_code =Str::random(25);
       $datos = $this->validate();
       $datos['confirmation_code'] = $confirmation_code;
       $mytime = Carbon::now();
       $null='nulll';
       $createdAt = Carbon::parse($datos['DateBirth']);
       $dateBirth=$createdAt->format('M d Y');
       $datecreated=$mytime->format('Y-m-d h:i');
       $website='https://besanaglobal.com?sponsor='.$datos['userName'];
       $pass=Hash::make($datos['Password']);

       //User::where('userName', $datos['invitedby'])->first();
        if (User::where('userName', $datos['invitedby'])->first()) {
                $user=User::where('userName', $datos['invitedby'])->first();


            try {


                $this->data = json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL SpAffiliated (
                'NEW',
                0,
                '{$datos['SSN']}',
                '{$datos['Name']}',
                '{$datos['LastName']}',
                {$datos['AlternativePhone']},
                {$datos['WorkPhone']},
                '{$datos['DateBirth']}',
                '{$datos['Email']}',
                null,
                '{$datos['Address']}',
                '{$datos['Country']}',
                '{$datos['State']}',
                '{$datos['City']}',
                {$datos['ZipCode']},
                {$datos['AlternativePhone']},
                '-12.34566',
                '12.34566',
                '{$datos['fechaingreso']}',
                null,
                '2023-01-23 03:40:31',
                1,
                '{$datos['userName']}',
                '{$pass}',
                '{$user->idAffiliated}',
                '{$website}',
                '{$confirmation_code}',
                3)")), true);

               
                $this->reset('SSN', 'Name', 'LastName', 'AlternativePhone', 'Workphone', 'DateBirth', 'Email', 'Address', 'Country', 'State', 'City', 'ZipCode',  'userName');
                $this->dispatchBrowserEvent('noty', ['msg' => 'Nuevo socio Activo: ' . $datos['userName']]);
                return;
                
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('noty', ['msg' => 'error de transaccion en base de datos: ' . $th]);
                return;
            }
        }else{
            $this->dispatchBrowserEvent('noty', ['msg' => 'Usuario no existe ']);
            return;
        }

    }

    public function verify($code) 
    {
        $user = Affiliate::where('confirmation_code', $code)->first();
       
      
        if (! $user){

            return redirect('/login');
        }else{
            $user->ConfirmedEmail = true;
            $user->confirmation_code = null;
            $user->save();
            return redirect('/login')->with('notification', 'You have confirmed your email correctly!');
        }


    }


}
