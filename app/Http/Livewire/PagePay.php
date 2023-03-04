<?php

namespace App\Http\Livewire;

use App\Models\Website;
use Livewire\Component;
use App\Models\Affiliate;
use Stripe;
use DB;
class PagePay extends Component
{
    
   public $onzasblade=0;
    public $total;
    public $taxtotal=0;
    public $pagoprueba;
    public $nameCard;
     protected $stripe;
    public $user;
    public $cantidadProductos;
  public $subTotal;
  public $activo;
  public $taxes   = 0;
  public $shipping = 0;
  public $totalcard = 0;
  public $cantidadinterna=0;

    protected $listeners = ['pay' => 'pay',
        'crearcliente'=>'crearcliente'];

  public function mount() {
    $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
    
    }
    public function render()
    {
      // $this->activo=Auth()->user()->active;
      // dd(Auth()->user());
      $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent();
      $this->subtotal=\Cart::session(Auth()->user()->idUser)->getSubTotal();
      

      $this->cantidadinterna=count($this->cantidadProductos);

      if ($this->cantidadinterna>0) {

        $totalonzas=0;
        foreach ($this->cantidadProductos as $key => $value) {
          $totalonzas+=$value->attributes->onzas*$value->quantity;
         
        }
        $this->onzasblade=$totalonzas;
        if ($totalonzas < 32 ) {
          $this->shipping = 7;
        }else{
          $shippinadd=intval($totalonzas-31);
          $this->shipping = intval($shippinadd+7);
         
        }
        $STRIPE_KEY = config('services.stripe.STRIPE_KEY');
        $variable = config('services.stripe.STRIPE_SECRET');
        $this->user=Affiliate::where('idAffiliated',Auth()->user()->idAffiliated)->first();
        $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
        // dd($this->user->Email);
          $items = [];
          $state=$this->user->State;

          switch (strtoupper($state)) {
            case 'NEVADA':
                $this->taxes=8.375;
                
              break;
            default:
                $this->taxes=0;
              break;
            }
        //  dd($this->taxes);
          $this->stripe = new \Stripe\StripeClient($variable);
          $b = $this->user;
        return view('livewire.page-pay',compact('b','STRIPE_KEY',))
          ->extends('layout.side-menu')
          ->section('subcontent');
      }else{
        return view('pages/dashboard-overview-1')
            ->extends('layout.side-menu')
            ->section('subcontent');
      }

    }
    public function pay($token, $name, $total, ){
      $variable = config('services.stripe.STRIPE_SECRET');
      $this->stripe = new \Stripe\StripeClient($variable);
      $totaltaxes=number_format(floatval($this->total*$this->taxes/100),2);
      $Totalfull=$totaltaxes+$this->total+$this->shipping;
      $metadata = [];
    // dd($this->cantidadProductos);
    $productos=[];
    $precio=[];
      foreach ($this->cantidadProductos as $pro) {
      $productos[]=[
        'id'=>$pro['id'],
        'precio'=>$pro['price'],
      ];
      
      $metadata[] = [
          'Producto' => $pro['name'],
          'Cantidad' => $pro['quantity'],
          'Precio' => floatval($pro['price']),
      ];
      }
    // dd($total);
      $metadata[]=[
        'Impuesto'=>$totaltaxes,
        'Envio'=>$this->shipping,
  
      ];
      $charge = $this->stripe->charges->create([
                'amount' => $total*100,
                'currency' => 'usd',
                'description' => json_encode($metadata),
                'source' => $token,
                'receipt_email'=>$this->user->Email,
               
            ]);
      $idAfiliado=Auth()->user()->idAffiliated;
      if ($this->cantidadinterna>1) {
        dd('ingreso a mayor que 1');
      }else{
        $website=Website::where('idAffiliated',$idAfiliado)->first();
    
        $id=$productos[0]['id'];
        $precio=floatval($productos[0]['precio']);
        $web=intval($website->idWebsite);
        try {
       
            DB::select('CALL SpSales(?,?, ?,?,?,?,?,?,?)', array(
              'Sale',
              $idAfiliado,
              $id,
              $web,
              $precio,
              'CASH',
              0,
              null,
              null, // Convertir a nulo si es una cadena vacía
          ));
          $this->ClearCart();
          return redirect('/products')->with('success', 'Compra Exitosa!!.');
        } catch (\Throwable $th) {
          dd($th);
        }
        

             
      }
           

            return back()->with('success', 'Pago realizado con éxito');
        
    }
      public function ClearCart()
      {
        \Cart::session(Auth()->user()->idUser)->clear();
        $this->cantidadProductos=\Cart::getContent()->count();
  
     }
}
