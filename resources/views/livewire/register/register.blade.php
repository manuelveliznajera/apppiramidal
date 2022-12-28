

    
    <div class="container">
        <!-- BEGIN: Login Info -->
        <div class="grid grid-cols-2 gap-4">
        
            <div class="col-1">
                <form method="POST" wire:submit.prevent="create" >
                    @csrf
                            <a href="" class="-intro-x flex items-center ">
                                <img src="{{asset('img/logowhite.png')}}" class="-intro-x object-cover h-48 w-96 " alt="besanaglobal">
                            {{-- <span class="text-5xl text-white">BESANA GLOBAL</span> --}}
                            </a>    
                            <div class="-intro-x flex">            
                                <fieldset class="-intro-x my-auto">
                                    <span class="-intro-x text-white text-lg ml-3 ">
                                        @if ($lenguaje=='spanish')
                                            Seleccione un Lenguaje:
                                        @else
                                            Selected Lenguage:
                                        @endif
                                    </span>
                                    <select wire:model.lazy="lenguaje" class="-intro-x p-2 bg-primary m-2 text-white rounded-lg w-64 text-center">
                                        <option value="english"> English </option>
                                        <option value="spanish"> Spanish </option>                     
                                    </select>              
                                
                                </fieldset>

                                <fieldset class="-intro-x my-auto">
                                    <span class="-intro-x text-white text-lg ml-3 ">
                                        @if ($lenguaje=='spanish')
                                                Seleccione un pais:
                                            @else
                                                Selected Country:
                                            @endif
                                        
                                    </span>
                                    <select wire:model.lazy="pais" class="-intro-x p-2 bg-primary m-2 text-white rounded-lg w-64 text-center">
                                        <option selected value="usa"> Seleccione su Pais: </option>
                                        <option value="usa"> Usa </option>
                                        <option value="mexico"> Mexico </option>
                                        <option value="guatemala"> Guatemala </option>
                                        <option value="colombia"> Colombia </option>
                                    </select>
                                </fieldset>
                            </div>
                            <span class="-intro-x  text-white  font-bold uppercase text-lg ">
                                @if ($lenguaje=='spanish')
                                    Datos Personales:
                                @else
                                    Data Person:
                                @endif
                          
                            </span>
                            <div class="w-full">                         
                                <div class="text-xl gap-2 items-center w-1/2">
                                    <input  id="Name"
                                    @if ($lenguaje=='spanish')
                                        placeholder="Ingrese su nombre"
                                        @else
                                        placeholder="Enter your name"            
                                    @endif
                                        class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')"
                                        required autofocus />
                                </div>
                            </div>
                            
                            <div class="mt-4 w-1/2">
                               
                                <div class="flex text-xl gap-2 items-center">
                                    <input id="LastName" class="-intro-x login__input form-control py-3 px-4 block" type="text"
                                    wire:model="LastName" :value="old('LastName')" required 
                                    @if ($lenguaje=='spanish')
                                        placeholder="Ingrese sus apelllidos"
                                        @else
                                        placeholder="Enter your Lastname"
                                        @endif
                                    />
                                </div>
                            </div>
                
                            <div class=" -intro-x w-full mt-3">                                 
                                        <label class="text-white" for="DateBirth"> BirthDate:</label>
                                        <br>
                                        <input id="DateBirth" class="-intro-x login__input form-control py-3  w-2/6" type="date"
                                        wire:model="DateBirth" :value="old('DateBirth')" required
                                        @if ($lenguaje=='spanish')
                                            placeholder="Ingrese su fecha de nacimiento"
                                        @else
                                            placeholder="Enter your DateBirth"
                                        @endif
                                            placeholder="Enter your DateBirth" /> 

                                        <input id="SSN" class="-intro-x  form-control py-3   w-2/6 "
                                            type="text" wire:model="SSN" :value="old('SSN')" required
                                            @if ($pais=='usa')
                                                placeholder="ENTER YOUR SSN"
                                            @elseif ($pais=='guatemala')
                                                placeholder="Ingrese su Dpi"
                                            @elseif ($pais=='colombia')
                                                placeholder="Ingrese su CC"
                                            @elseif ($pais=='mexico')
                                                placeholder="Ingrese su FRC"
                                            @else
                                                placeholder="ENTER YOUR ID"
                                            @endif
                                                />
                                        @error('SSN') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                        </div>  @enderror

                                  
                            </div>

                            <span class="-intro-x  text-white p-2 font-bold uppercase text-lg">Datos de Sistema:</span>    

                            <div class=" -intro-x grid grid-cols-2 gap-4"> 
                                <div class="w-full">
                                        <div class="col-1">
                                                @if ($lenguaje=='spanish')
                                                <label class="text-white" for="Invitedby"> Invitado Por:</label>
                                            @else
                                                <label class="text-white" for="Invitedby"> Invited By:</label>                        
                                            @endif
                                        </div>
                                        <div class="col-2">

                                            <input id="Invitedby" class="-intro-x login__input form-control py-3" type="text"
                                            wire:model="invitedby"  :value="old('DateBirth')" required />
                                        </div>
                                </div>                          
                                <div class="w-full">
                                    <div class="col-1">
                                        @if ($lenguaje=='spanish')
                                            <label class="text-white" for="Invitedby"> Ingrese su Nombre de Usuario:</label>
                                        @else
                                            <label class="text-white" for="Invitedby"> Enter your username:</label>                        
                                        @endif
                                    </div>
                                    <div class="col-2">
                                        <input id="userName" class="-intro-x  form-control py-3  "
                                        type="text" wire:model="userName" :value="old('userName')" required
                                        @if ($lenguaje=='english')
                                            placeholder="INGRESE UN NOMBRE DE USUARIO"
                                        @else
                                            placeholder="ENTER YOUR USERNAME"
                                        @endif
                                            />
                                            @error('userName') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                    </div>
                                </div> 
                                    
                            </div>
                            {{-- caja para password y confirm password --}} 
                            <div class="-intro-x grid grid-cols-2 gap-2 mt-3">
                                    <div class="w-fulll">
                                        <div class="col-1">
                                            <label for="Password" class="-intro-x text-white"> 
                                                @if ($lenguaje=='spanish')
                                                    Contraseña
                                                @else
                                                    Password
                                                @endif
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <input id="Password" class="-intro-x  form-control py-3" type="password" wire:model="Password"
                                            required />
                                        </div>
                                        
                                            {{-- <x-input-error :messages="$errors->get('Password')" class="mt-2" /> --}}
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="-intro-x w-full ">
                                        <div class="col-1">
                                            <label for="confirmPassword" class="-intro-x text-white"> 
                                                @if ($lenguaje=='spanish')
                                                        Confirmar Contraseña
                                                    @else
                                                        Password Confirm
                                                    @endif
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <input id="confirmPassword" class="-intro-x  form-control py-3" type="password"
                                                wire:model="confirmPassword"  required />
                                        </div>
                                            
                                            {{-- <x-input-error :messages="$errors->get('confirmPassword')" class="mt-2" /> --}}                               
                                    </div>   
                            </div>
            </div>   
        
            {{-- fin columna uno --}}
            <div class="col-2 h-screen bg-gray-300 p-5 mt-5 rounded-lg">
                            <span class="-intro-x  text-white p-2 font-bold uppercase text-lg bg-primary rounded-lg">Contac Data:</span>  
                            <div class="flex w-full gap-2">
                                <div class="mt-2  w-2/4">
                                    <label class="font-extrabold text-lg" for="Workphone"> Phone:</label>
                                    <input id="Workphone" class="intro-x  login__input form-control block mt-1 w-3/4 text-white" type="number" wire:model="Phone"
                                            :value="old('Workphone')" required autofocus />
                                    {{-- <x-input-error :messages="$errors->get('Workphone')" class="mt-2" /> --}}
                                </div>
                                <!-- PHONE -->
                                <div class="w-2/4 mt-2">
                                    <label class="font-extrabold text-lg" for="Phone"> WorkPhone:</label>
                                    <input id="Phone" class="intro-x  text-white login__input form-control block mt-1 w-3/4" type="number" wire:model="Workphone"
                                            :value="old('Phone')"  autofocus />
                                    {{-- <x-input-error :messages="$errors->get('Phone')" class="mt-2" /> --}}
                                </div>
                            </div> 
                            {{-- Email  --}}
                            <div class="w-full mt-2">
                                <label class="font-extrabold text-lg" for="Email"> Email:</label>
                                    <input id="Email" class="intro-x  text-white login__input form-control block mt-1 w-3/4" type="Email" wire:model="Email"
                                        :value="old('Email')" required autofocus placeholder="Enter your email..." />
                                        @error('Email') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                        </div>  @enderror
                            </div>
                            {{-- confirm email --}}
                            <div class="w-full mt-2 mb-3">
                                <label class="font-extrabold text-lg" for="confirmEmail"> Confirm Email:</label>
                                <input id="confirmEmail" class="intro-x  text-white login__input form-control block mt-1 w-3/4" type="email" name="confirmEmail"
                                        :value="old('confirmEmail')" required autofocus placeholder="Confirm email..."/>
                                {{-- <x-input-error :messages="$errors->get('confirmEmail')" class="mt-2" /> --}}
                            </div>  
                            {{-- addres  --}}
                            <span class="-intro-x  text-white p-2 font-bold uppercase text-lg bg-primary rounded-lg">Address Data:</span>  
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
                                    id="Address" class="intro-x  text-white login__input form-control block mt-1 w-3/4" type="text" wire:model="Address"
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
                                            :value="old('Country')" required autofocus />
                                    </div>           
                                    {{-- <x-input-error :messages="$errors->get('Country')" class="mt-2" /> --}}
                                </div>
                                <!-- State/Province -->
                                <div class="w-2/4 mt-2">
                                    <label for="State"> State:</label>

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
                                    <label for="City"> City:</label>
                                    <div class="flex text-xl gap-2 items-center">
                                        <i class="fas fa-City"></i>
                                        <input id="City" class="intro-x login__input form-control block mt-1 w-3/4" type="text" wire:model="City"
                                            :value="old('City')" required autofocus />
                                    </div>
                        
                                    {{-- <x-input-error :messages="$errors->get('City')" class="mt-2" /> --}}
                                </div>
                                <!-- Zip -->
                                <div class="mt-2  w-2/4">
                                    <label for="ZipCode"> Zipcode:</label>
                                    <div class="flex text-xl gap-2 items-center">
                                        <i class="fab fa-usps"></i>
                                        <input id="ZipCode" class="intro-x login__input form-control block mt-1 w-3/4" type="text" wire:model="ZipCode"
                                            :value="old('ZipCode')" required autofocus />
                                    </div>
                        
                        
                                    {{-- <x-input-error :messages="$errors->get('ZipCode')" class="mt-2" /> --}}
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a class="intro-x login__input underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    Already Registered?
                                </a>
                                
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                                    Register
                                </button>
                                
                            </div>
                        
            </div>
                
        </form>
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
            window.onload = () => {
            const myInput = document.getElementById('confirmEmail');
            myInput.onpaste = e => e.preventDefault();
            }
            confirmEmail
        </script>
    </div>

        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        
        
     
               
              