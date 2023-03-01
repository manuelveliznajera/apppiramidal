
<div>
    
       
    <div class="flex flex-row bg-white p-2">    
                     
                        <div class="basis-1/4 p-3">
                           
                                    <div class="">
                                    
                                    <h1 class="font-bold uppercase text-xl p-2 bg-gray-300 rounded mb-3">BILLING ADDRESS</h1>
                                       
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <span  class="input-group-text" id="basic-addon1">Name</span>
                                        <input id="name" value="{{$b->Name}}" type="text" class="form-control" placeholder="{{$b->Name}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                  
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Last name</span>
                                        <input readonly value="{{$b->LastName}}" type="text" class="form-control" placeholder="{{$b->LastName}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Email</span>
                                        <input id="email" value="{{$b->Email}}" readonly type="text" class="form-control" placeholder="{{$b->Email}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Phone</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->Phone}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">ZipCode</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->ZipCode}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" >Address</span>
                                        <input id="address" value="{{$b->Address}}" readonly type="text" class="form-control" placeholder="{{$b->Address}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">Country</span>
                                        <input id="country" value="{{$b->Country}}" readonly type="text" class="form-control" placeholder="" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">State</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->State}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">City</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->City}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                        </div> 
                        {{-- fin de la primera columna --}}
                                                
                         
                        
                        <div class="basis-2/4 p-3 text-center">
                            
                                <h1 class="font-bold uppercase text-xl p-2 bg-gray-300 rounded mb-3">Detalle de Compra</h1>
                              
                            
                                <h2>{{$onzasblade}}</h2>
                                <h2>Total Envio:{{$shipping}}</h2>


                                <table class="table-responsive text-center w-full">
                                    <thead>
                                        <tr>                              
                                            <th class="p-2 bg-primary text-white">CANTIDAD</th>
                                            <th class="p-2 bg-primary text-white">PRODUCTO</th>      
                                            <th class="p-2 bg-primary text-white">PRECIO</th>
                                            <th class="p-2 bg-primary text-white">IMPUESTO</th>
                                            <th class="p-2 bg-primary text-white">SUB-TOTAL</th>                                         
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        @forelse($cantidadProductos as $pro)
                                        @php
                                            $taxunique=($pro->price*$taxes)/100;
                                            $taxblade=$taxunique*$pro->quantity;
                                            $taxtotal+=$taxblade;
                                            $totalblade=$total+$taxtotal;
                                        @endphp
                                        <tr class="border-4  border-b-gray-500">
                                            <td class="text-center"><span class="badge badge-info">{{$pro->quantity}}</span></td>
                                            <td class=" pr-5"> <span class=""> {{$pro->name}}</span></td>
                                            <td class=" text-right">$ {{ number_format(floatval($pro->price),2) }}</td>
                                            <td class=" text-right ">$ {{number_format(floatval($taxblade),2)}}</td>                                       
                                            <td class="text-right">{{number_format(floatval(($pro->price*$pro->quantity)+$taxblade),2)}}</td>                                           
                                        </tr>
                                        @empty
                                        <tr class="border-4 border-indigo-200 border-b-indigo-500">
                                            <td colspan="6">
                                                NO DATA
                                            </td>
                                        </tr>
                                        @endforelse
                                        <tr>
                                            <td></td>
                                            <td class="text-center ">
                                                Subtotal:
                                            </td>
                                             <td></td>
                                            <td >  <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold "> {{number_format(floatval($totalblade),2)}}</h1></td>
                                        </tr> 
                                        <tr>
                                            <td></td>
                                            <td class="text-center ">
                                                Envio:
                                            </td>
                                             <td></td>
                                            <td >  <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold "> {{number_format(floatval($shipping),2)}}</h1></td>
                                        </tr>   
                                        <tr >
                                            <td></td>
                                          <td class="text-center ">
                                            TOTAL: $.
                                          </td>
                                          <td></td>
                                            <td >  <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold "> {{number_format(floatval($totalblade+$shipping),2)}}</h1></td>
                                        </tr>      
                                    </tbody>
                                </table>
                           
                        </div>   
                        <div class="basis-2/4 p-3 bg-gray-200">
                            <div class="">
                                <h1 class="font-bold uppercase text-xl p-2 bg-gray-600 rounded mb-3 text-white text-center">METODO DE PAGO</h1>     
                            </div>
                            <div class="input-group mb-3">
                                <h1 class="fw-bold text-dark">Accepted Cards:</h1>    
                                <img src="{{asset('img/creditcard.png')}}" class="object-fill h-10 w-66" alt=""> 
                            </div>
                            
                            <div class="input-group mb-3">
                               {{-- <span class="badge badge-success">TOTAL:</span> <h2 class="badge badge-success">{{$total}}</h2> --}}
                             </div>
                            
                            
                              
                                  <form id="payment-form" 
                                   {{-- wire:submit.prevent="pay"   --}}
                                  >
                                  @csrf
                                 
                                      
                                      <label class="font-black uppercase text-base" for="">Total:</label>
                                      <input id="totalfull" type="text" value="{{number_format(floatval($totalblade+$shipping),2)}}" class="-intro-y form-control">
                                      <label class="font-black uppercase text-base" for="nameCard">Nombre:</label>
                                     <input type="text" id="nameCard" class="-intro-x form-control" placeholder="Nombre del Titular">
                                     <label class="font-black uppercase text-base" for="nameCard">Datos de Tarjeta:</label>

                                    <div id="card-element" >

                                    </div>
                                    <div id="payment-element" >

                                    </div>
                                    
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                    
                                
                            
                            <div class="card-footer">                        
                              <button
                              id="card-button"
                              type="submit"
                              class="btn btn-primary mt-3"
                            >  Pagar      </button>
                        
                            </div>
                        </form>
                </div>                                                                                   
                </div>     
</div>
</div>
@push('javascript')
    

<script>

    const city="{{$b->City}}"
    const keystripe="{{ $STRIPE_KEY }} ";

 

    var stripe= Stripe(keystripe);

    var elements = stripe.elements();
    var cardElement = elements.create('card',{
  style: {
    base: {
      iconColor: '#c4f0ff',
      color: 'black',
      fontWeight: '500',
      fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
      fontSize: '16px',
      fontSmoothing: 'antialiased',
      ':-webkit-autofill': {
        color: 'primary',
      },
      '::placeholder': {
        color: 'green',
      },
    },
    invalid: {
      iconColor: 'red',
      color: 'white',
    },
  },
});
    
        cardElement.mount('#payment-element');
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    
        // const payElement = elements.create('card');
        // payElement.mount('#card-element');
        
        var form = document.getElementById('payment-form');
        const cardButton = document.getElementById('card-button');
        // var stt=  stripe.updatePaymentIntent(paymentIntentId,{
        //         'amount_details':amount_details
        //     });
 

        form.addEventListener('submit', async(event)=> {

            event.preventDefault();
            let nameCard=  document.getElementById('nameCard').value
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const address = document.getElementById('address').value;
                const totalfull = document.getElementById('totalfull').value;

              
            cardButton.disabled = true;

            stripe.createToken(cardElement, { name: nameCard }).then(function(result) {
            if (result.error) {
                console.log(result.error)
            } else {
                // Enviar el token a tu servidor
                var input = document.createElement('input');
            
                Livewire.emit('pay',result.token.id, name, totalfull)
                //  form.submit();
                console.log(result.token.id)
            }
            });
           
                
        });
       
        
    </script>
@endpush

