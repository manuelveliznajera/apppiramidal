<div>
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <h1 class="-intro-x text-white text-6xl">BIENVENIDOS</h1>
                </a>
                <div class="my-auto">
                    <img alt="Icewall Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('img/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-3xl leading-tight mt-10">Unos clics más para Iniciar <br> sesión en su cuenta.</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8  xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <img src="{{asset('img/logologin.jpeg')}}" alt="" height="200px" width="300px">
                    
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Ingresar</h2>
                    <div class="intro-x  text-slate-400 xl:hidden text-center">Unos clics más para Iniciar sesión en su cuenta.</div>
                    @include('common.notification')
                    <div class="intro-x mt-2">                  
                        <form  method="POST" 
                        wire:submit.prevent="login"        
                        >
                        @csrf
                            <input id="userName" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Usuario" wire:model="username">
                            <div id="error-email" class="login__input-error text-danger mt-2"></div>
                            <input id="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4"  wire:model="password">
                            <div id="error-password" class="login__input-error text-danger mt-2"></div>    
                    </div>
                    <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                            <label class="cursor-pointer select-none" for="remember-me">Recuerdame</label>
                        </div>
                        <a href="">¿Olvidasté tu contraseña?</a>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button 
                        {{-- id="btn-login" --}}
                       
                        class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Ingresar</button>
                    </form>
                        <a href="{{route('login.register')}}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Registrarse</a>
                    </div>
                    <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
                        By signin up, you agree to our <a class="text-primary dark:text-slate-200" href="">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200" href="">Privacy Policy</a>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
   
</div>


<script >
      
        
        
        
           
    window.addEventListener('noty', event => {
        Swal.fire('', event.detail.msg)
        if (event.detail.action == 'close-modal') fireModal(0)
    })

</script>
