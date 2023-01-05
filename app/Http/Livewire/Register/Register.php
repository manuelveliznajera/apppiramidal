<?php

namespace App\Http\Livewire\Register;

use App\Models\Affiliate;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class Register extends Component
{
   

    public $pais;
    public $lenguaje='english';
    public $invitedby;
    public $SSN='34098989';
    public $Name='Alex';
    public $LastName='Hurtado';
    public $AlternativePhone;
    public $Workphone='000000000';
    public $DateBirth;
    public $Email='alex@example.com';
    public $ConfirmedEmail='alex@example.com';
    public $Address='Calle 1';
    public $Country='Colombia';
    public $State='Atalntico';
    public $City='Barranquilla';
    public $ZipCode='01800';
    public $Phone='00000000';
    public $Latitude;
    public $Longitude;
    public $userName='alexHurtado';
    public $Password='12345678';
    public $confirmPassword='12345678';
    public array $data;
    public $message='';
    public $confirmation_code;



    protected $rules=[
        'SSN' => 'required',
        'Email' => 'required',
        'userName'=>'required|unique:users',
      
        'Name'=>'required|string',
        'LastName'=>'required|string',
        'AlternativePhone'=>'nullable|string',
        'Workphone'=>'required|string',
        'DateBirth'=>'required|string',
        
        'Address'=>'required|string',
        'Country'=>'required|string',
        'State'=>'required|string',
        'City'=>'required|string',
        'ZipCode'=>'required|string',
        'Phone'=>'required|string',
       
        'Password'=>'required|string'
    ];

    public function mount(String $id='besana'){
        $this->invitedby = $id;
        $this->lenguaje='english';
       
       
    }

    public function render()
    {
    
        
        return view('livewire.register.register')
                ->extends('layout.top-menu')
                ->section('content');
    }
    // protected $rules = [
    //     'SSN' => 'required|unique:affiliates',
    //     'email' => 'required|unique:affiliates',
    //     'userName'=>'required|unique:users'
    // ];
    public function create(){

       $confirmation_code =Str::random(25);
       $datos = $this->validate();
       $datos['confirmation_code'] = $confirmation_code;
     
       $mytime = Carbon::now();
       $null='nulll';
       $createdAt = Carbon::parse($datos['DateBirth']);
       $dateBirth=$createdAt->format('M d Y');
       $datecreated=$mytime->format('Y-m-d h:i');
       $website='https://www.besanaglobal.com/'.$datos['userName'];
       $pass=Hash::make($datos['Password']);

     

       $user = User::create([
        'userName' => $this->userName,
        'Name' => $this->Name,
        'LastName' => $this->LastName,
        'LastName' => $this->LastName,
        'SSN' => $this->SSN,
        'Phone' => $this->Phone,
        'Workphone' => $this->Workphone,
        'DateBirth' => $this->DateBirth,
        'Address' => $this->Address,
        'Country' => $this->Country,
        'State' => $this->State,
        'City' => $this->City,
        'ZipCode' => $this->ZipCode,
        'Email' => $this->Email,
        'password' => Hash::make($this->Password),
        'confirmation_code' =>  $confirmation_code 
       ]);


       Mail::send('livewire.register.confirmation_code', $datos, function($message) use ($datos) {
        $message->to($datos['Email'], $datos['Name'])->subject('Por favor confirma tu correo');
    });

    //    $this->data=json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL SpAffiliated ('NEW',0,'{$datos['SSN']}','{$datos['Name']}','{$datos['LastName']}',{$datos['Workphone']},{$datos['Phone']},'{$datos['DateBirth']}','{$datos['Email']}',null,'{$datos['Address']}','{$datos['Country']}','{$datos['State']}','{$datos['City']}',{$datos['ZipCode']},'333.333','12.345545','-12.34566','$datecreated',null,null,1,'{$datos['userName']}','{$pass}',1,'{$website}')")),true);
    

            $this->reset('SSN', 'Name',  'LastName', 'AlternativePhone','Workphone',  'DateBirth', 'Email','Address', 'Country','State','City','ZipCode','Phone','userName');

            $this->dispatchBrowserEvent('noty', ['msg' => 'We have send a menssage to your for confirm your register']);
          
            // return redirect()->route('login');

    }

    public function verify($code) 
    {
        $user = User::where('confirmation_code', $code)->first();

        if (! $user)
        return redirect('/logi');

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        return redirect('/login')->with('notification', 'You have confirmed your email correctly!');
    }

    // public function Editar(Affiliate $affiliate){

    //     dd($affiliate);
    // }
}
