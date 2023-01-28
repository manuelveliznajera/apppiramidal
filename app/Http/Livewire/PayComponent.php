<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;
use Stripe;
use Carbon\Carbon;

class PayComponent extends Component
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
      $cantidad=count($this->cantidadProductos);
      if ($cantidad>0) {
        
        $STRIPE_KEY = config('services.stripe.STRIPE_KEY');
        $variable = config('services.stripe.STRIPE_SECRET');
        $this->user=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();
        $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
          $items = [];
          foreach ($this->cantidadProductos as $pro) {
             $items = $pro->name;
          }
          $this->stripe = new \Stripe\StripeClient($variable);
          $payment_intent = $this->stripe->paymentIntents->create([
            'amount' => $this->total*100,
            'description'=>$items,
            'currency' => 'usd',
            "payment_method_types"=> [
              "card"
            ],
            'receipt_email'=>$this->user->Email,
          ]);
          $b = $this->user;
    
          $this->intent = $payment_intent->client_secret;
      
          return view('livewire.pay-component',compact('b','STRIPE_KEY'))
          ->extends('layout.side-menu')
          ->section('subcontent');
      }else{
      return view('pages/dashboard-overview-1')
        ->extends('layout.side-menu')
        ->section('subcontent');

      }

    }

  
 public function crearcliente()
{
  $afiliado=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();
  $afiliado->firstBuy=Carbon::now()->format('Y-m-d H:i:s');
    $afiliado->save();

  \Cart::session(Auth()->user()->idUser)->clear();
  $variable = config('services.stripe.STRIPE_SECRET');

  $stripe = new \Stripe\StripeClient($variable);
    
  $stripe->customers->create(
    [
      'description'=>'Cliente desde Besanaglobal.com',
      'email' => $this->user->Email,
      'name'=>$this->user->Name,
      'phone'=>$this->user->Phone,
      
    ]
  );

    return redirect('/products');
       
    
} 



}
