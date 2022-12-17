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
    public $cantidadProductos;

    protected $listeners = ['payer' => 'payer'];
    
    public function mount() {
        $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();

        \Stripe\Stripe::setApiKey('sk_test_51M8A3cCrrdI1PPjaK18eGoDnSsZUNQbUeul0DYNQfxUzMdMdkh7R6mxnnztPAD2qhyG0dl5J7dReKUPMTFrlxVvU000hqz3xNw');
        		
		
		$amount = 4000;
        // the real price is 40  you have to multiply by 100.
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => intval($this->total),
			'currency' => 'usd',
			'description' => 'Payment From Codehunger',
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
