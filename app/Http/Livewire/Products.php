<?php

namespace App\Http\Livewire;

use App\Models\Line;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $products=[];
    public $subTotal;
    public $session=2;
    public $total;

    public function render()
    {
      
        $this->total=\Cart::session(Auth()->user()->idUser)->getContent()->count();
        $lines=Line::all();
        $this->products=Product::all();
        //dd($products);
        return view('livewire.products',)->extends('layout.side-menu')
                ->section('subcontent');
    }
    public function addCart($id, $cant=1){
      
        //dd($idProd);
        //$cantTem=\Cart::getContent()->count();
         $cantTem=\Cart::session(Auth()->user()->idUser)->getContent()->count();
          
        
         // dd($id);
  
         
          // $product=json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL SpProducts ('U_PROD',null,null,null,null,null,null,$id)")));
          // dd($product);
        //  $product=Product::where('idProd',$id)->first();
         //  dd($product);
  
          // $cartAdd= \Cart::add(
          //     $this->products[$id]['idProd'],
          //     $this->products[$id]['name'],
          //     $this->products[$id]['price'],
          //     $cant,
          //     $this->products[$id]['img']
          // );
          //$userId=Auth()->user()->id;
         //$iduser=2;
         \Cart::session(Auth()->user()->idUser)->add(array(
            'id' => $this->products[$id]['idProd'], // inique row ID
            'name' => $this->products[$id]['name'],
            'price' => $this->products[$id]['price'],
            'quantity' => $cant,
             'attributes'=>array(
               'img'=>$this->products[$id]['img']
             ),
            
        ));
          // $this->cantidadProductos=\Cart::getContent()->count();
          $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent($id)->count();
  
          if ($this->cantidadProductos==$cantTem) {
            $this->dispatchBrowserEvent('noty', ['msg' => 'Producto Actualizado la cantidad']);
          $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent($id)->count();
  
          }else{
            $this->dispatchBrowserEvent('noty', ['msg' => 'Producto nuevo agregado!']);
  
          }
          
          //Cart::add(455, 'Sample Item', 100.99, 2, array());
         
          
      }
  
      public function ClearCart()
      {
        \Cart::session(Auth()->user()->idUser)->clear();
        $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent()->count();
  
      }
}
