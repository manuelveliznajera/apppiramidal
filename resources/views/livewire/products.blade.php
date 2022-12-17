<div>
    
    <div class="shadow-md fixed flex inline" 
   style="margin-top: 40px;
   z-index: 500;
   top: 10;
   margin-right: 100px;
  
   right: 0;"
                > 
                    <a href="{{route('payment')}}" class="btn btn-outline-primary flex  " 
                   
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
   

    <div class="grid grid-cols-12 gap-6 mt-5">
       
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
           
            <button class="btn btn-primary shadow-md mr-2">Add New Product</button>
            <span class="intro-x text-primary">
                @auth
                    autenticado
                @endauth
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
        <!-- BEGIN: Users Layout -->
       
        @forelse ($products as $key=> $pro)
            <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                <div class="box">
                    <div class="p-5">
                        {{-- <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/5"> --}}
                        <div class="   rounded-md overflow-hidden " style="height: 250px;">

                            <img alt="{{$pro->name}}" class="object-contain h-48 w-96" src="{{ asset('img/products/' . $pro->img) }}" />
                           
                                {{-- <span class="absolute top-0 bg-pending/80 text-white text-xs m-5 px-2 py-1 rounded z-10">Featured</span> --}}
                          
                            <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                                <a href="" class="block font-medium text-base">{{ $pro->name }}</a>
                                <span class="text-white/90 text-xs mt-3">{{ $pro->name }}</span>
                            </div>
                        </div>
                        <div class="text-slate-600 dark:text-slate-500 mt-5">
                            <div class="flex items-center">
                                <i data-lucide="link" class="w-4 h-4 mr-2"></i> Price: ${{ $pro->price }}
                            </div>
                            <span> <p class="font-bold">Description:</p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem ad repudiandae necessitatibus nostrum qui consectetur consequuntur. Perferendis reprehenderit nisi eius, sequi quae suscipit animi in neque, quod enim quasi vero.</span>
                            
                          
                        </div>
                    </div>
                    <div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        
                        <button class="flex items-center mr-3 btn btn-outline-danger" wire:click="addCart({{$key}})">
                            <img class="text-transparent" src="{{asset('img/cart.svg')}}" alt="" width="30px"> Add Cart
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
        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
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
