<div>
    
<div class="shadow shadow-green-600 shadow-2xl fixed flex inline " 
   style="margin-top: 40px;
   z-index: 500;
   top: 10;
   margin-right: 100px;
   right: 0;"
                > 
                    <a href="{{route('cart-pay')}}" class="btn btn-outline-primary flex  " 
                   
                    >
                    <i class="fa-solid fa-cart-shopping fs-4 mr-2"></i>
                    <span class=" "  >
                    {{$total}}
                    <img class="color-white-300 text-white " src="{{asset('img/cart.svg')}}" alt="" width="20px">

                    </span>
                    </a>
    
                    <button onclick="limpiar()""  class="btn btn-outline-danger ml-2"  >Clear cart</button>

</div>
    <h2 class="intro-y text-lg font-medium mt-10">Product Grid</h2>
   

    <div class="grid grid-cols-3 gap-4 mt-5">
       
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
           
            
            <button class="btn btn-primary shadow-md mr-2">Onzas total:{{$onzas}}</button>
            <button class="btn btn-primary shadow-md mr-2">Shipping $:{{$shipping}}</button>


            <span class="intro-x text-primary">
         
            </span>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                
            </div>
        </div>
    </div>
        <!-- BEGIN: Users Layout -->
        <div class="intro-y grid grid-cols-3 gap-4 mt-3">
        @forelse ($products as $key => $pro)
            
                <div class="col-span-1 box shadow rounded rounded-lg border-double border-4 border-gray-400
                    @if ($pro->idLine==3)
                        shadow-belleza
                    @else
                        shadow-salud
                    @endif
                    shadow-xl">
                    
                        <div class="   rounded-md overflow-hidden " >
                            <img alt="{{$pro->name}}" class="object-contain h-48 w-96" src="{{ asset('img/products/'.$pro->img) }}" />
                        </div>
                        
                
                        <div class="text-slate-600 rounded rounded-lg dark:text-slate-500 mt-1
                            @if ($pro->idLine==3)
                                bg-belleza
                            @else
                                bg-salud
                            @endif
                        ">
                            <div class="flex flex-col items-center  p-2 text-dark">
                                <h1 class="block font-medium text-base">{{$pro->name}}</h1>
                                 Price: ${{ $pro->price }}
                                 <span class="font-black">Puntos a Recibir:</span>
                                 <span class="font-black ">{{$pro->puntos}} Puntos</span>
                                 <button class="btn btn-primary btn-sm " wire:click="addCart({{$key}})">
                                     Add Cart
                                </button>

                            </div>
                           
                        </div>
                </div> 
            @empty
            <div>
                <span colspan="6">
                    NO DATA
                </span>
            </div>
        @endforelse
    </div>
</div>
<script>
    function fireModal(action = 1) {
console.log("click")
        if (action == 1) {
            document.querySelector('.modal').classList.add('show')
            document.querySelector('.modal').style.display = 'block'
        } else {
            document.querySelector('.modal').classList.add('hide')
            document.querySelector('.modal').style.display = 'none'
        }
    }



    window.addEventListener('modal-open', event => {
        fireModal(1)
    })

    window.addEventListener('noty', event => {
        Swal.fire('', event.detail.msg)
        if (event.detail.action == 'close-modal') fireModal(0)
    })


    
    function limpiar() {
        Swal.fire({
            title: 'Info',
            text: "¿CONFIRM CLEAR?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                /// Swal.fire('Deleted!', 'Your file has been deleted.', 'success')
                //window.livewire.emit('Destroy', CustomerId) // 1,2 ,3
                @this.ClearCart()
            }
        })
    }
    
</script>
