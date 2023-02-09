<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Affiliate;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;
use Stripe;
use Carbon\Carbon;
class PagePay extends Component
{
    
    public $intent ;
    public $total;
    public $pagoprueba;
    public $nameCard;
     protected $stripe;
    public $user;
    public $cantidadProductos;

    protected $listeners = ['payer' => 'payer',
        'crearcliente'=>'crearcliente'];

  public function mount() {
    $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
    $variable = config('services.stripe.STRIPE_SECRET');
    }
    public function render()
    {
      $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent();
        // dd($this->cantidadProductos);
      $cantidad=count($this->cantidadProductos);
      if ($cantidad>0) {
        $STRIPE_KEY = config('services.stripe.STRIPE_KEY');
        $variable = config('services.stripe.STRIPE_SECRET');
        $this->user=Affiliate::where('idAffiliated',Auth()->user()->idAffiliated)->first();
     
        $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
          $items = [];
          foreach ($this->cantidadProductos as $pro) {
        $idcart = $pro->id;
             $name = $pro->name;
        $priceproducto = $pro->attributes->producto;
              $tax = $pro->attributes->tax;
        $shipping = $pro->attributes->shipping;
        $membresia = $pro->attributes->membresia;

          }
          $amount_details = array(
            "Producto" => $priceproducto,
            "Membresia"=>$membresia,
            "Tax" => $tax,
            "Shipping" => $shipping
          );
          $this->stripe = new \Stripe\StripeClient($variable);

          // $payment_intent = $this->stripe->paymentIntents->create([
          //   "amount" => $this->total*100,            
          //   "currency" => 'usd',  
          //   "payment_method_types"=> [
          //     "card"
          //   ],
          //   "description"=>$name,
          //   "receipt_email"=>$this->user->Email,
           
          // ]);
          $b = $this->user;
    
      //     $this->intent = $payment_intent->client_secret;
      // $idIntente = $payment_intent->id;
      
        return view('livewire.page-pay',compact('b','STRIPE_KEY',))
          ->extends('layout.side-menu')
          ->section('subcontent');
      }else{
        return view('pages/dashboard-overview-1')
            ->extends('layout.side-menu')
            ->section('subcontent');
      }

    }

    public function CartShop($id, $price, $onzas){

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
}
