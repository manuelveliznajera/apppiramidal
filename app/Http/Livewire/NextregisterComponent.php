<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NextregisterComponent extends Component
{
    public $items=[];
  public $totalOnzas;
    public $total=0;
    public array $datas=[];
  public $membresia = false;
  public $taxes = 0;
  public $shipping = 0;
  public $state;

  

    public $cantidadProductos=0;
    public function render()
    {
      //  dd(Auth()->user()->idUser);
    $af = User::where('idUser', Auth()->user()->idUser)->first();
    $Affiliated = Affiliate::where('idAffiliated', $af->idAffiliated)->first();
    // dd($Affiliated->State);

    $this->state = strtoupper($Affiliated->State);
      $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent()->count();
      $this->items=\Cart::session(Auth()->user()->idUser)->getContent();
        $this->total=\Cart::session(Auth()->user()->idUser)->getTotal();
        return view('livewire.nextregister-component')
            ->extends('layout.login')
            ->section('content');
    }
      public function onzasPrice( $val )
      {
        $this->totalOnzas += $val;

        if ($val==0) {
            return;
        }
        if ($this->shipping==0) {
          $this->shipping = 7;
          return;
         }elseif ($this->totalOnzas > 0 ||$this->totalOnzas<32) {
          $this->shipping += 2;
           
         }elseif ($this->totalOnzas > 64) {
          $this->shipping += 7;
         }
       

      }
    public function addCart($id, $price, $onzas){

       $this->onzasPrice($onzas);
    $taxState = 0;
        switch ($this->state) {
          case 'NEVADA':
              $taxState=8.375;
              
            break;
          case 'CALIFORNIA':
              $taxState=6.5;
            break;
          case 'UTAH':
              $taxState=4.7;
            break;
          case 'OTHER':
              $taxState=0;
            break;
        
        }
        $existMem=\Cart::session(Auth()->user()->idUser)->getContent(0)->count();
        
        if ($price==24.95) {
          
          if ( $existMem > 0) {
                return;
            }
              $priceTax = $price;
              \Cart::session(Auth()->user()->idUser)->add(array(
                'id' => 0, // inique row ID
                'name' => 'Membresia',
                'price' => 24.95,
                'quantity' => 1,
            ));
            $this->membresia = true;
            return;
        }
        $this->taxes = round($price * $taxState/100, 2);
        $priceTax    = round($this->taxes + $price, 2);


        if ($this->membresia==false) {
              \Cart::session(Auth()->user()->idUser)->add(array(
                'id' => 0, // inique row ID
                'name' => 'Membresia',
                'price' => 24.95,
                'quantity' => 1,
            ));
            $this->membresia = true;
          }

         $cantTem=\Cart::session(Auth()->user()->idUser)->getContent()->count();
           
          \Cart::session(Auth()->user()->idUser)->add(array(
            'id' => $id, // inique row ID
            'name' => 'Package #'.$id.'Tax: '.$this->taxes,
            'price' => $priceTax,
            'quantity' => 1,
             
            
        ));
          

          $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent($id)->count();
  
          if ($this->cantidadProductos==$cantTem) {
            $this->dispatchBrowserEvent('noty', ['msg' => 'Producto Actualizado la cantidad']);
          $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent($id)->count();
  
          }else{
            $this->dispatchBrowserEvent('noty', ['msg' => 'Producto nuevo agregado!']);
  
          }  
          
      }

      public function ClearCart()
      {
        \Cart::session(Auth()->user()->idUser)->clear();
        $this->cantidadProductos=\Cart::getContent()->count();
  
     }

     public function logout()
     {
        Auth::logout();
        return redirect()->route('login');

     }
      
}
