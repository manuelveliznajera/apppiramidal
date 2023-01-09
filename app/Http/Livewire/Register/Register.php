<?php

namespace App\Http\Livewire\Register;

use App\Models\Affiliate;

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
    public $SSN='';
    public $Name='';
    public $LastName='';
    public $AlternativePhone;
    public $Workphone='000000000';
    public $DateBirth;
    public $Email='';
    public $ConfirmedEmail='';
    public $Address='';
    public $Country='';
    public $State='';
    public $City='';
    public $ZipCode='';
    public $Phone='00000000';
    public $Latitude;
    public $Longitude;
    public $userName='';
    public $Password='';
    public $confirmPassword='';
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

       $this->data=json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL SpAffiliated ('NEW',0,'{$datos['SSN']}','{$datos['Name']}','{$datos['LastName']}',{$datos['Workphone']},{$datos['Phone']},'{$datos['DateBirth']}','{$datos['Email']}',null,'{$datos['Address']}','{$datos['Country']}','{$datos['State']}','{$datos['City']}',{$datos['ZipCode']},'333.333','12.345545','-12.34566','$datecreated',null,null,1,'{$datos['userName']}','{$pass}',1,'{$website}')")),true);

       Mail::send('livewire.register.confirmation_code', $datos, function($message) use ($datos) {
        $message->to($datos['Email'], $datos['Name'],$datos['confirmation_code'])->subject('Por favor confirma tu correo');
    });

    //    $this->data=json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL SpAffiliated ('NEW',0,'{$datos['SSN']}','{$datos['Name']}','{$datos['LastName']}',{$datos['Workphone']},{$datos['Phone']},'{$datos['DateBirth']}','{$datos['Email']}',null,'{$datos['Address']}','{$datos['Country']}','{$datos['State']}','{$datos['City']}',{$datos['ZipCode']},'333.333','12.345545','-12.34566','$datecreated',null,null,1,'{$datos['userName']}','{$pass}',1,'{$website}')")),true);
    

            $this->reset('SSN', 'Name',  'LastName', 'AlternativePhone','Workphone',  'DateBirth', 'Email','Address', 'Country','State','City','ZipCode','Phone','userName');

            $this->dispatchBrowserEvent('noty', ['msg' => 'We have send a menssage to your for confirm your register']);
          
            // return redirect()->route('login');

    }

    public function verify($code) 
    {
        // $user = Affiliate::where('confirmation_code', $code)->first();
        $user = true;
        if (! $user)
            return redirect('/login');

        // $user->confirmed = true;
        // $user->confirmation_code = null;
        // $user->save();

        return redirect('/login')->with('notification', 'You have confirmed your email correctly!');
    }

    // public function Editar(Affiliate $affiliate){

    //     dd($affiliate);
    // }
}
