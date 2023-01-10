<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginComponent extends Component
{
    public $username, $password, $mensaje;

   
    public function render()
    {
        return view('livewire.login-component')
        ->extends('layout.login')
        ->section('content');
    }

    public function login()
    {
       $user=User::where('userName',$this->username)->first();
      // dd($user->Password);
        if ($user!=null) {
            if (password_verify($this->password, $user->Password)) {
                //dd('password correcto');
                Auth::login($user);
               if (Auth()->user()) {
                    $id=Auth()->user()->idAffiliated;
                    $status=Affiliate::where('idAffiliated',$id)->get();

                   //dd($status[0]);
                   if ($status[0]['ConfirmedEmail']) {

                        if (!$status[0]['firstBuy']) {
                            return redirect()->route('addpackage');
                        }else{
                            return redirect()->route('products');
                        }


                   }else{
                    $this->dispatchBrowserEvent('noty', ['msg' => 'Confirme su usuario por email!.']);
                   }
               }else{
                return redirect()->route('login');

               }
              
            } else {
                $this->dispatchBrowserEvent('noty', ['msg' => 'Password Incorrecto!.']);


            }
        }else{
            $this->dispatchBrowserEvent('noty', ['msg' => 'User not Exist!.']);

        }

       
        // if (!\Auth::attempt([
        //     'userName' => $this->username,
        //     'password' => $this->password
        // ])) {
        //     $this->dispatchBrowserEvent('noty', ['msg' => 'Wrong email or password.']);

        //     // throw new \Exception('Wrong email or password.');
        // }else{
        //     $this->dispatchBrowserEvent('noty', ['msg' => 'Successfull.']);


        // }

    }
}
