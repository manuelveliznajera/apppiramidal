<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Stripe;

class PayComponent extends Component
{
    public $intent ;
    
    public $total;
    public $nameCard;
    public $cantidadProductos;

    protected $listeners = ['payer' => 'payer'];
    
    public function mount() {
         $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
        $variable = env('STRIPE_KEY');
       // dd($variable);

         \Stripe\Stripe::setApiKey($variable);

        // \Stripe\Stripe::setApiKey('sk_test_51M8A3cCrrdI1PPjaK18eGoDnSsZUNQbUeul0DYNQfxUzMdMdkh7R6mxnnztPAD2qhyG0dl5J7dReKUPMTFrlxVvU000hqz3xNw');
        
        		
		
	
      
        
        $payment_intent = \Stripe\PaymentIntent::create([
			
			'amount' => $this->total*100,
			'currency' => 'usd',
			'description' => 'PAGO',
			'payment_method_types' => ['card'],
		]);
		$this->intent = $payment_intent->client_secret;
    }
    public function render()
    {
      
        $b=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();

        $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
        $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent();

        return view('livewire.pay-component',compact('b'))
        ->extends('layout.side-menu')
        ->section('subcontent');
    }

   

    

}
