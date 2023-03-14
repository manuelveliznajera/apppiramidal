<div>
   
    
    <div class="container">
        <!-- BEGIN: Login Info -->
        <div class="grid grid-cols-2 gap-4">
            

        
            <div class="col-1">
                <form  wire:submit.prevent="create" >
                    @if (session()->has('mensaje'))
                            <div class=" w-full  alert alert-success">
                                {{ session('mensaje') }}
                            </div>
                        @endif
                            <span class=" font-bold uppercase text-lg ">
                                    {{__('personal information')}}:
                            </span>
                            <div class="w-full">                         
                                <div class="text-xl gap-2 items-center w-1/2">
                                    <input  id="Name"
                                        placeholder="{{__('Enter your name')}}"
                                        class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')"
                                        required autofocus />
                                </div>
                            </div>
                            
                            <div class="mt-4 w-1/2">
                               
                                <div class="flex text-xl gap-2 items-center">
                                    <input id="LastName" class="-intro-x login__input form-control py-3 px-4 block" type="text"
                                    wire:model="LastName" :value="old('LastName')" required 
                                    placeholder="{{__('Enter your lastname')}}"
                                    />
                                </div>
                                <label class="text-gray-600" for="fechaingreso">
                                    {{__('date of admission')}}:
                                </label>
                                <div class="flex text-xl gap-2 items-center">
                                    
                                    <input id="fechaingreso" class="-intro-x login__input form-control py-3 px-4 block" type="date"
                                    wire:model="fechaingreso" :value="old('fechaingreso')" required 
                                    
                                    />
                                </div>
                            </div>
                
                            <div class=" -intro-x w-full mt-3">                                 
                                        <label class="text-gray-600" for="DateBirth">
                                                {{__('Birthday')}}:
                                            </label>
                                        <br>
                                        <input id="DateBirth" class="-intro-x login__input form-control py-3  w-2/6" type="date"
                                        wire:model="DateBirth" :value="old('DateBirth')" required
                                         /> 

                                        <input id="SSN" class="-intro-x  form-control py-3   w-2/6 "
                                            type="text" wire:model="SSN" :value="old('SSN')" required
                                                placeholder="{{__('Enter your SSN')}}"
                                                />
                                        @error('SSN') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                        </div>  @enderror

                                  
                            </div>

                            <span class="-intro-x  p-2 font-bold uppercase text-lg">{{__('System Data')}}:</span>    

                            <div class=" -intro-x grid grid-cols-2 gap-4"> 
                                <div class="w-full">
                                        <div class="col-1">
                                                <label class="text-gray-600" for="Invitedby"> {{__('Invited by')}}:</label>
                                        </div>
                                        <div class="col-2">
                                            <input id="Invitedby" class="-intro-x login__input form-control py-3" type="text"
                                            wire:model="invitedby"  :value="old('DateBirth')" required />
                                        </div>
                                </div>                          
                                <div class="w-full">
                                    <div class="col-1">
                                       
                                            <label class="text-gray-600" for="Invitedby">{{__('Username')}}:</label>
                                    </div>
                                    <div class="col-2">
                                        <input id="userName" class="-intro-x  form-control py-3  "
                                        type="text" wire:model="userName" :value="old('userName')" required
                                            placeholder="{{__('Username')}}"
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
                                                    {{__('Password')}}
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
                                                        {{__('Confirm Password')}}
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
                            <div class="-intro-x grid grid-cols-2 gap-2 mt-3">
                                <div class="w-full p-3">
                                    <input type="checkbox" class="-intro-x bg-primary " style=" input:checked {
                                        background-color:green;
                                    }" wire:model="asignarSocio">

                                    <span>{{__('Do you want to make a placement')}}? </span>
                                    @if ($asignarSocio)
                                        <div wire:ignore>
                                            <select class="form-control" id="select2-dropdown" wire:model='asignacionSocio'>
                                                <option value="">{{__('Select Partner')}}</option>
                                                @foreach($webseries as $item)
                                                <option value="{{ $item->idAffiliated }}">{{ $item->userName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>

                </div>   
            
                {{-- fin columna uno --}}
                <div class="col-2 h-screen bg-gray-300 p-5 mt-5 rounded-lg">
                                <span class="-intro-x  text-white p-2 font-bold uppercase text-lg bg-primary rounded-lg">{{__('CONTACT INFORMATION')}}:</span>  
                                <div class="flex w-full gap-2">
                                    <div class="mt-2  w-2/4">
                                        <label class="font-extrabold text-lg" for="AlternativePhone"> {{__('Cell phone')}}:</label>
                                        <input id="AlternativePhone" class="intro-x  login__input form-control block mt-1 w-3/4 " type="number" wire:model="AlternativePhone"
                                                :value="old('AlternativePhone')" required autofocus />
                                    </div>
                                    <!-- PHONE -->
                                    <div class="w-2/4 mt-2">
                                        <label class="font-extrabold text-lg" for="WorkPhone"> {{__('Phone')}}:</label>
                                        <input id="WorkPhone" class="intro-x   login__input form-control block mt-1 w-3/4" type="number" wire:model="WorkPhone"
                                                :value="old('WorkPhone')"  autofocus />
                                        {{-- <x-input-error :messages="$errors->get('Phone')" class="mt-2" /> --}}
                                    </div>
                                </div> 
                                {{-- Email  --}}
                                <div class="w-full mt-2">
                                    <label class="font-extrabold text-lg" for="Email"> {{__('Email')}}:</label>
                                        <input id="Email" class="intro-x   login__input form-control block mt-1 w-3/4" type="Email" wire:model="Email"
                                            :value="old('Email')" required autofocus placeholder="{{__('Email')}}" />
                                            @error('Email') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                </div>
                                {{-- confirm email --}}
                                <div class="w-full mt-2 mb-3">
                                    <label class="font-extrabold text-lg" for="confirmEmail"> {{__('Confirm Email')}}:</label>
                                    <input id="confirmEmail" class="intro-x   login__input form-control block mt-1 w-3/4" type="email" wire:model="confirmEmail"
                                            :value="old('confirmEmail')" required autofocus placeholder="{{__('Confirm Email')}}"/>
                                            @error('confirmEmail') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                </div>  
                                {{-- addres  --}}
                                <span class="-intro-x  text-white p-2 font-bold uppercase text-lg bg-primary rounded-lg">{{__('LOCATION DATA')}}:</span>  
                                <div class="w-full mt-2">
                                        <label  for="Address"> 
                                                {{__('Address')}}:
                                        </label>
                                    <div class="flex text-xl gap-2 items-center">  
                                        <input
                                         placeholder="{{__('Address')}}"
                                        id="Address" class="intro-x   login__input form-control block mt-1 w-3/4" type="text" wire:model="Address"
                                            :value="old('Address')" required autofocus />
                                    </div>           
                                    {{-- <x-input-error :messages="$errors->get('Address')" class="mt-2" /> --}}
                                </div>
                                <div class="flex w-full gap-2">
                                    <div class="mt-2  w-2/4">
                                        <label for="Country">
                                                {{__('Country')}}:
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
                                        <label for="State"> {{__('State')}}:</label>
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
                                        <label for="City"> {{__('City')}}:</label>
                                        <div class="flex text-xl gap-2 items-center">
                                            <i class="fas fa-City"></i>
                                            <input id="City" class="intro-x login__input form-control block mt-1 w-3/4" type="text" wire:model="City"
                                                :value="old('City')" required autofocus />
                                        </div>
                            
                                        {{-- <x-input-error :messages="$errors->get('City')" class="mt-2" /> --}}
                                    </div>
                                    <!-- Zip -->
                                    <div class="mt-2  w-2/4">
                                        <label for="ZipCode"> {{__('ZipCode')}}:</label>
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
                                    <span>{{__('Accept to')}} <button onclick="terminos()">{{__('Terms and Conditions')}}</button> </span>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="intro-x login__input underline text-sm text-gray-600 hover:text-gray-900 mr-3" href="{{ route('login') }}">
                                        {{__('You are already registered')}}?
                                    </a>
                                    
                                    <button 
                                        @if ($terminos==false)
                                            disabled
                                        @else 
                                            
                                        @endif
                                    class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" type="submit">
                                        {{__('Register')}}
                                    </button>
                                    
                                </div>
                            
                </div>
                
                </form>
        </div>
   
        <script>
            
                $('#select2-dropdown').select2();
                $('#select2-dropdown').on('change', function (e) {
                    var data = $('#select2-dropdown').select2("val");
                    @this.set('ottPlatform', data);
                });
          
        </script>
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
        
    </div>       
     
               
              
