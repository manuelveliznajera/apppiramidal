

    
    <div class="container">
        <!-- BEGIN: Login Info -->
        <div class="grid grid-cols-2 gap-4">
        
            <div class="col-1">
                <form method="POST" wire:submit.prevent="create" >
                    @csrf
                            <span class=" font-bold uppercase text-lg ">
                                    Datos Personales:
                            </span>
                            <div class="w-full">                         
                                <div class="text-xl gap-2 items-center w-1/2">
                                    <input  id="Name"
                                        placeholder="Ingresar nombre"
                                        class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')"
                                        required autofocus />
                                </div>
                            </div>
                            
                            <div class="mt-4 w-1/2">
                               
                                <div class="flex text-xl gap-2 items-center">
                                    <input id="LastName" class="-intro-x login__input form-control py-3 px-4 block" type="text"
                                    wire:model="LastName" :value="old('LastName')" required 
                                    placeholder="Ingresar apellidos"
                                    />
                                </div>
                                <label class="text-gray-600" for="fechaingreso">
                                    Fecha de ingreso:
                                </label>
                                <div class="flex text-xl gap-2 items-center">
                                    
                                    <input id="fechaingreso" class="-intro-x login__input form-control py-3 px-4 block" type="date"
                                    wire:model="fechaingreso" :value="old('fechaingreso')" required 
                                    
                                    />
                                </div>
                            </div>
                
                            <div class=" -intro-x w-full mt-3">                                 
                                        <label class="text-gray-600" for="DateBirth">
                                                Fecha de cumpleaños:
                                            </label>
                                        <br>
                                        <input id="DateBirth" class="-intro-x login__input form-control py-3  w-2/6" type="date"
                                        wire:model="DateBirth" :value="old('DateBirth')" required
                                         /> 

                                        <input id="SSN" class="-intro-x  form-control py-3   w-2/6 "
                                            type="text" wire:model="SSN" :value="old('SSN')" required
                                                placeholder="Ingrese su SSN"
                                                />
                                        @error('SSN') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                        </div>  @enderror

                                  
                            </div>

                            <span class="-intro-x  p-2 font-bold uppercase text-lg">Datos de Sistema:</span>    

                            <div class=" -intro-x grid grid-cols-2 gap-4"> 
                                <div class="w-full">
                                        <div class="col-1">
                                                <label class="text-gray-600" for="Invitedby"> Invitado Por:</label>
                                        </div>
                                        <div class="col-2">
                                            <input id="Invitedby" class="-intro-x login__input form-control py-3" type="text"
                                            wire:model="invitedby"  :value="old('DateBirth')" required />
                                        </div>
                                </div>                          
                                <div class="w-full">
                                    <div class="col-1">
                                       
                                            <label class="text-gray-600" for="Invitedby">Nombre de Usuario:</label>
                                    </div>
                                    <div class="col-2">
                                        <input id="userName" class="-intro-x  form-control py-3  "
                                        type="text" wire:model="userName" :value="old('userName')" required
                                            placeholder="Ingrese usuario"
                                            />
                                            @error('userName') 
                                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                    </div>
                                </div> 
                                    
                            </div>
                            {{-- caja para password y confirm password --}} 
                            <div class="-intro-x grid grid-cols-2 gap-2 mt-3">
                                    <div class="w-fulll">
                                        <div class="col-1">
                                            <label for="Password" class="-intro-x text-gray-600"> 
                                                    Contraseña
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <input id="Password" class="-intro-x  form-control py-3"   type="text" wire:model="Password"
                                            required />
                                            @error('Password') 
                                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                                            </div>  
                                            @enderror
                                        </div>
                                        
                                            {{-- <x-input-error :messages="$errors->get('Password')" class="mt-2" /> --}}
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="-intro-x w-full ">
                                        <div class="col-1">
                                            <label for="password_confirmation" class="-intro-x text-gray-600"> 
                                                        Confirmar Contraseña
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <input id="password_confirmation" class="-intro-x  form-control py-3" type="text"
                                                wire:model="password_confirmation" placeholder="Besanabg2023"  required value="Besanabg2023"/>
                                                @error('password_confirmation') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                    <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                                                </div>  @enderror
                                        </div>
                                            
                                            {{-- <x-input-error :messages="$errors->get('confirmPassword')" class="mt-2" /> --}}                               
                                    </div>   
                            </div>
                </div>   
            
                {{-- fin columna uno --}}
                <div class="col-2 h-screen bg-gray-300 p-5 mt-5 rounded-lg">
                                <span class="-intro-x  text-white p-2 font-bold uppercase text-lg bg-primary rounded-lg">DATOS DE CONTACTO:</span>  
                                <div class="flex w-full gap-2">
                                    <div class="mt-2  w-2/4">
                                        <label class="font-extrabold text-lg" for="AlternativePhone"> Celular:</label>
                                        <input id="AlternativePhone" class="intro-x  login__input form-control block mt-1 w-3/4 " type="number" wire:model="AlternativePhone"
                                                :value="old('AlternativePhone')" required autofocus />
                                    </div>
                                    <!-- PHONE -->
                                    <div class="w-2/4 mt-2">
                                        <label class="font-extrabold text-lg" for="WorkPhone"> Teléfono:</label>
                                        <input id="WorkPhone" class="intro-x   login__input form-control block mt-1 w-3/4" type="number" wire:model="WorkPhone"
                                                :value="old('WorkPhone')"  autofocus />
                                        {{-- <x-input-error :messages="$errors->get('Phone')" class="mt-2" /> --}}
                                    </div>
                                </div> 
                                {{-- Email  --}}
                                <div class="w-full mt-2">
                                    <label class="font-extrabold text-lg" for="Email"> Email valido:</label>
                                        <input id="Email" class="intro-x   login__input form-control block mt-1 w-3/4" type="Email" wire:model="Email"
                                            :value="old('Email')" required autofocus placeholder="Ingrese correo electronico" />
                                            @error('Email') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                </div>
                                {{-- confirm email --}}
                                <div class="w-full mt-2 mb-3">
                                    <label class="font-extrabold text-lg" for="confirmEmail"> Confirmar Email:</label>
                                    <input id="confirmEmail" class="intro-x   login__input form-control block mt-1 w-3/4" type="email" wire:model="confirmEmail"
                                            :value="old('confirmEmail')" required autofocus placeholder="Confirmar correo electronico."/>
                                            @error('confirmEmail') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                </div>  
                                {{-- addres  --}}
                                <span class="-intro-x  text-white p-2 font-bold uppercase text-lg bg-primary rounded-lg">DATOS DE UBICACION:</span>  
                                <div class="w-full mt-2">
                                        <label  for="Address"> 
                                            
                                            @if ($lenguaje=="spanish")
                                                Dirección:
                                            @else
                                                Address:
                                            @endif
                                        </label>
                                    <div class="flex text-xl gap-2 items-center">
                                        
                                        <input
                                        @if ($lenguaje=="spanish")
                                            placeholder="Ingrese su Dirección"
                                        @else
                                            placeholder="Enter your Address"
                                        @endif
                                        id="Address" class="intro-x   login__input form-control block mt-1 w-3/4" type="text" wire:model="Address"
                                            :value="old('Address')" required autofocus />
                                    </div>           
                                    {{-- <x-input-error :messages="$errors->get('Address')" class="mt-2" /> --}}
                                </div>
                                <div class="flex w-full gap-2">
                                    <div class="mt-2  w-2/4">
                                        <label for="Country">
                                            @if ($lenguaje=="spanish")
                                                Pais:
                                            @else
                                                Country:
                                            @endif 
                                        </label>
                                        <div class="flex text-xl gap-2 items-center">
                                            <i class="fas fa-globe-americas"></i>
                                            <input id="Country" class="intro-x login__input form-control block mt-1 w-3/4" type="text" wire:model="Country"
                                                :value="old('Country')" required placeholder="Usa"/>
                                        </div>           
                                        {{-- <x-input-error :messages="$errors->get('Country')" class="mt-2" /> --}}
                                    </div>
                                    <!-- State/Province -->
                                    <div class="w-2/4 mt-2">
                                        <label for="State"> Estado/Provincia:</label>

                                        <div class="flex text-xl gap-2 items-center">
                                            <i class="fas fa-university"></i>
                                            <input id="State" class="intro-x login__input form-control block mt-1 w-3/4" type="text" wire:model="State"
                                                :value="old('State')" required autofocus />
                                        </div>
                            
                            
                                        {{-- <x-input-error :messages="$errors->get('State')" class="mt-2" /> --}}
                                    </div>
                                </div>

                                <div class="flex w-full gap-2">
                                    <div class="mt-2  w-2/4">
                                        <label for="City"> Ciudad:</label>
                                        <div class="flex text-xl gap-2 items-center">
                                            <i class="fas fa-City"></i>
                                            <input id="City" class="intro-x login__input form-control block mt-1 w-3/4" type="text" wire:model="City"
                                                :value="old('City')" required autofocus />
                                        </div>
                            
                                        {{-- <x-input-error :messages="$errors->get('City')" class="mt-2" /> --}}
                                    </div>
                                    <!-- Zip -->
                                    <div class="mt-2  w-2/4">
                                        <label for="ZipCode"> Código Postal:</label>
                                        <div class="flex text-xl gap-2 items-center">
                                            <i class="fab fa-usps"></i>
                                            <input id="ZipCode" class="intro-x login__input form-control block mt-1 w-3/4" type="text" wire:model="ZipCode"
                                                :value="old('ZipCode')" required autofocus />
                                        </div>
                            
                            
                                        {{-- <x-input-error :messages="$errors->get('ZipCode')" class="mt-2" /> --}}
                                    </div>
                                </div>
                                <div class="w-full p-3">
                                    <input type="checkbox" class="-intro-x bg-primary " style=" input:checked {
                                        background-color:green;
                                    }" wire:model="terminos">
                                    <span>Acepto los <button onclick="terminos()">Terminos y Condiciones</button> </span>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="intro-x login__input underline text-sm text-gray-600 hover:text-gray-900 mr-3" href="{{ route('login') }}">
                                        Ya estas registrado?
                                    </a>
                                    
                                    <button 
                                        @if ($terminos==false)
                                            disabled
                                        @else 
                                            
                                        @endif
                                    class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" wire:click="create()">
                                        Registrarse
                                    </button>
                                    
                                </div>
                            
                </div>
                
                </form>
        </div>
        <script>
            function fireModal(action = 1) {
            
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
                // Swal.fire('', event.detail.msg)
                // if (event.detail.action == 'close-modal') fireModal(0)
                    Swal.fire(
                    'Mensaje',
                    event.detail.msg,
                    'info'
                    ).then(result => {
                        if(result.isConfirmed){
                            // window.location = '/socioactivo'
                        }
                    }
                        
                    )
             
            })
            window.addEventListener('error', event => {
                // Swal.fire('', event.detail.msg)
                // if (event.detail.action == 'close-modal') fireModal(0)
                    Swal.fire(
                    'Error',
                    event.detail.msg,
                    'error'
                    ).then(result => {
                        if(result.isConfirmed){
                           
                        }
                    }
                        
                    )
             
            })
           
            function terminos(){
                Swal.fire({
                title: 'Terminos y Condiciones',
                text: 'Mensaje de prueba',
                // imageUrl: 'https://unsplash.it/400/200',
                // imageWidth: 400,
                // imageHeight: 200,
                // imageAlt: 'Custom image',
                })
            }
            // window.onload = () => {
            // const myInput = document.getElementById('confirmEmail');
            // myInput.onpaste = e => e.preventDefault();
            // }
           
        </script>
    </div>

        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        
        
     
               
              
