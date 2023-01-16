<div>
    
       
    <div class="flex flex-row bg-white p-2">    
                     
                        <div class="basis-1/4 p-3">
                           
                                    <div class="input-group mb-3">
                                    
                                    <h1 class="fw-bold text-dark">BILLING ADDRESS</h1>
                                        
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
                        <div class="basis-2/4 py-2">
                                    <div class="input-group mb-3">
                                        <h1 class="fw-bold text-dark">PAYMENT</h1>     
                                    </div>
                                    <div class="input-group mb-3">
                                        <h1 class="fw-bold text-dark">Accepted Cards:</h1>     
                                    </div>
                                    <div class="input-group mb-3">
                                       <img src="{{asset('img/creditcard.png')}}" alt="" style=" height:100px">    
                                    </div>
                                    <div class="input-group mb-3">
                                       <span class="badge badge-success">TOTAL:</span> <h2 class="badge badge-success">{{$total}}</h2>
                                     </div>
                                      <form action=""   id="payment-form">
                                        @csrf  
                                      <div class="form-group">
                                        <div class="card-header">
                                            <label for="card-element">
                                                DATA PAY
                                            </label>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="form-outline">
                                                  <input type="text" id="nameCard" class="-intro-x login__input form-control py-3 px-4  mb-3 w-3/4" placeholder="Name card"/>
                                               
                                                </div>
                                            </div>
                                            <div class="rounded-lg  bg-gray-200">
                                                <div id="card-element" class="-intro-x login__input form-control py-3 px-4 w-3/4" >

                                            </div>
                                                
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                            <input type="hidden" name="plan" value="" />
                                        </div>
                                    </div>
                                    <div class="card-footer">                        
                                      <button
                                      id="card-button"
                                      class="btn btn-primary mt-2 w-1/4"
                                      type="submit"
                                      data-secret="{{ $intent }}"
                                    >  Payer      </button>
                                          
                                    </div>
                                </form>
                        </div>                           
                         
                        
                        <div class="basis-1/4 py-2">
                            
                                <h1>Cantidad de Productos</h1>
                                <span class="badge badge-success">{{$cantidadProductos->count()}}</span>
                                <img src="{{asset('img/cart.svg')}}" alt="" width="100px">
                                <table class="table-responsive">
                                    <thead>
                                        <tr>                                        
                                            <th class="">PRODUCT</th>      
                                            <th class="">PRICE</th>
                                            <th class="">QUANTITY</th>
                                            <th class="d-flex justify-content-end">TOTAL</th>                                         
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        @forelse($cantidadProductos as $pro)
                                        <tr>
                                            <td class=" pr-5">
                                                {{-- <img src="{{asset('img/products/'.$pro->attributes['img'])}}" class="card-img-top img-thumbnail mt-3" alt="{{$pro->name}}" style="width: 40px; height:40px;">    --}}
                                                <span class=""> {{$pro->name}}</span>
                                                {{-- <button wire:click="remove({{$pro->id}})" class="btn btn-sm btn-outline-warning m-2">Eliminar</button> --}}
                                            </td>
                                            <td class=" d-flex ">${{$pro->price}}</td>
                                            <td class="text-center">
                                                        <span class="badge badge-info">{{$pro->quantity}}</span>                                   
                                            </td>
                                            <td class="d-flex justify-content-end">
                                                {{$pro->quantity * $pro->price}}
                                            </td>                                           
                                        </tr>                                     
                                        @empty
                                        <tr>
                                            <td colspan="6">
                                                NO DATA
                                            </td>
                                        </tr>
                                        @endforelse    
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="mt-5"></td>
                                            <td>  <h1 class="mt-5 badge badge-dark">TOTAL: {{$total}}</h1></td>
                                        </tr>      
                                    </tbody>
                                </table>
                           
                        </div>                                                                                   
                </div>     
</div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)

    var style = {
        base: {
            color: 'dark',
            backgroundColor:'white',
            lineHeight: '48px',
            padding:'12px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '20px',
            '::placeholder': {
                color: 'gray'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    const keystripe = '{{ env('STRIPE_KEY') }}';

  
     const stripe = Stripe(keystripe, { locale: 'es' }); // Create a Stripe client.
    // const stripe = Stripe('pk_test_51IR4JwCBDL6tBtH5NVoIgkKfCLS7VsJJZtrmlxAxldvhDvTq5DwJ0irP4Rboo0EKkjL8A1XUMyJtpO2STD7vyP9G00YnNeS843', { locale: 'es' }); // Create a Stripe client.

    
    
    const elements = stripe.elements(); // Create an instance of Elements.
    const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
    document.getElementById('')
    const cardButton = document.getElementById('card-button');
    document.addEventListener("DOMContentLoaded", () => {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;

    });
    



    const clientSecret = cardButton.dataset.secret;
    console.log(clientSecret)

    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

    // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
      let nameCard=  document.getElementById('nameCard').value

    stripe.handleCardPayment(clientSecret, cardElement, {
            payment_method_data: {
                billing_details: { 
                    name:nameCard,
                    email:email,
                    address:address 
                }
            }
        })
        .then(function(result) {
            console.log(result)
           if (result.error) {
    
                 var errorElement = document.getElementById('card-errors');
                 errorElement.textContent = result.error.message;

                //   alert('there is an error paiement') ;
                Swal.fire('', errorElement.textContent)

              } else {
             if (result.paymentIntent.status === 'succeeded') {

                Swal.fire('success', 'Pago efectuado!!')
               
                // Livewire.emit('payer') ;

                  
    
                }
                 else if (result.paymentIntent.status === 'requires_payment_method') {
      
                  
                    
                     alert('there is an error paiement') ;
              }
              }
            
        });
    });
</script>



