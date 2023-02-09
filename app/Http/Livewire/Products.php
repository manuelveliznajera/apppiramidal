<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\Line;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $products=[];
    public $subTotal;
    public $session=2;
    public $total;
    public $taxes = 0;
    public $shipping = 0;
    public $onzas=0;
  public $registrado = 0;
  public $puntosTemporal=0;
    public function render()
    {
      
      $afiliado=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();

      
        $this->total=\Cart::session(Auth()->user()->idUser)->getContent()->count();
        $lines=Line::all();
        $this->products=Product::all();
      //  dd($this->products);
        return view('livewire.products', compact('afiliado'))->extends('layout.side-menu')
                ->section('subcontent');
    }
    public function onzasPrice( $val )
      {
        $this->totalOnzas = $val;

        switch ($val) {
          case 2:
            $this->shipping = 7;
            break;
            case 4:
            $this->shipping = 14;
              break;
        }
      }

      private function obtenerOnzas($id){
    $value = $id;
        switch ($value) {
            case 0:
                $this->onzas+=3;
              break;
            case 1:
                $this->onzas=$this->onzas+24; 
                break;
            case 2:
                $this->onzas=$this->onzas+3;
                break; 
            case 3:
                $this->onzas=$this->onzas+2;
                break;
            case 4:
                $this->onzas=$this->onzas+3;
                break;  
            case 5:
                $this->onzas=$this->onzas+8;
                break;
            case 6:
                $this->onzas=$this->onzas+5;
                break;
            case 7:
                $this->onzas=$this->onzas+5;
                break; 
        }
      }
    public function addCart($id, $cant=1 ){

    $this->obtenerOnzas($id);
    if ($this->onzas < 32 ) {
        $this->shipping = 7;
      }else{
        $residual = intval($this->onzas - (31+$this->registrado));
        $this->registrado += $residual;
        $this->shipping += $residual;
      }
      // $this->onzasPrice($onzas);
      $taxState = 0;
          // switch ($this->state) {
          //   case 'NEVADA':
          //       $taxState=8.375;
                
          //     break;
          //   default:
          //       $taxState=0;
          //     break;
          
          // }
    $newprice = 0;
    
         $cantTem=\Cart::session(Auth()->user()->idUser)->getContent()->count();
          
         \Cart::session(Auth()->user()->idUser)->add(array(
            'id' => $this->products[$id]['idProd'], // inique row ID
            'name' => $this->products[$id]['name'],
            'price' => $this->products[$id]['price'],
            'quantity' => $cant,
             'attributes'=>array(
               'img'=>$this->products[$id]['img'],
               'puntos'=>$this->products[$id]['puntos'],
             ),
            
        ));
    $this->puntosTemporal = $this->products[$id]['puntos'];
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
        $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent()->count();
  
      }
}
