<div class="grid grid-cols-1  ">
<div class="flex flex-col md:flex-row justify-center text-center ">
    <div class="flex justify-center p-2 text-center">
        <img src=" {{asset('img/LogoWhite.png')}}" class="-intro-x object-fit h-32 w-64 " alt="besanaglobal">

    </div>
    <div class="w-full text-center md:mt-4">
        @include('../layout/change')
    </div>
    
</div>           
 

<div class="grid grid-cols-1 md:grid-cols-2 gap-1 h-screen  overflow-y-scroll p-3 ">
    <div class="bg-slate-700 bg-opacity-70 p-4">
        
        <form method="POST" wire:submit.prevent="create" >
            @csrf
      
   
        <span class="-intro-x  text-white  font-bold uppercase text-lg ">
           {{__('personal information')}}
        
        </span>
        <div class="w-full">                         
           
            <input  id="Name"
                placeholder="{{__('Enter your name')}}"
                class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')"
                required autofocus />
        </div>

        <div class="mt-2 w-full">
            <div class="flex text-xl gap-2 items-center">
                <input id="LastName" class="-intro-x login__input form-control py-3 " type="text"
                wire:model="LastName" :value="old('LastName')" required 
                    placeholder="{{__('Last Name')}}"
                />
            </div>
        </div>
        <div class=" -intro-x grid grid-cols-1 md:grid-cols-2 gap-2 mt-3"> 
                    <div class="flex flex-col">
                        <label class="text-white" for="DateBirth">
                            {{__('Birthday')}}
                        </label>
                        <input id="DateBirth" class="-intro-x  form-control py-3" type="date" wire:model="DateBirth" :value="old('DateBirth')" required /> 
                    </div>                                
                    <div class="flex flex-col md:ml-3">
                        <label class="text-white" for="SSN">
                            {{__('Enter your SSN')}}
                        </label>
                        <input id="SSN" class="-intro-x  form-control form-control py-3 "
                            type="text" wire:model="SSN" :value="old('SSN')" required
                                placeholder="{{__('Enter your SSN')}}"
                                />
                        @error('SSN') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>  @enderror
                    </div>
        </div>

        <span class="-intro-x mt-4 text-white p-2 font-bold uppercase text-lg ">{{__('System Data')}}:</span>    
        <div class=" -intro-x grid grid-cols-1 md:grid-cols-2 gap-2"> 
            <div class="flex flex-col">
                <label class="text-white" for="Invitedby"> {{__('Invited by')}}:</label>
                <input id="Invitedby" class="-intro-x  form-control py-3" type="text"
                wire:model="invitedby"  :value="old('invitedby')" required />
                   
            </div>                          
            <div class="flex flex-col md:ml-3">
                <label class="text-white" for="Invitedby">{{__('Username')}}:</label>
                <input id="userName" class="-intro-x  form-control py-3  " type="text" wire:model="userName" :value="old('userName')" required placeholder="{{__('Username')}}" />
                @error('userName') 
                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                 <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}
                </span>
                </div>  
                @enderror
            </div> 
        </div>
        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="flex flex-col">
                <label for="Password" class="-intro-x text-white"> 
                        {{__('Password')}}
                </label>
                <input id="Password" class="-intro-x  form-control py-3" type="password" wire:model="Password" required />
                @error('Password') 
                    <div class="intro-x bg-red-600 p-2 rounded-lg ">
                        <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                    </div>  
                @enderror
            </div>
            <div class="-intro-x flex flex-col md:ml-3 ">
                <label for="password_confirmation" class="-intro-x text-white"> 
                            {{__('Confirm Password')}}
                </label>
                <input id="password_confirmation" class="-intro-x  form-control py-3" type="password" wire:model="password_confirmation"  required />
                    @error('password_confirmation') 
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                        </div>  
                    @enderror
            </div>   
        </div>
    </div>
    <div class= "bg-slate-800 bg-opacity-70 p-4">
        
        <span class="-intro-x  text-white font-bold uppercase text-lg">{{__('CONTACT INFORMATION')}}:</span>  
        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="-intro-x flex flex-col">
                <label class="-intro-x text-white" for="Workphone"> {{__('Cell phone')}}:</label>
                <input id="Workphone" class="-intro-x  form-control py-3 " type="number" wire:model="Phone" :value="old('Workphone')" required autofocus />
            </div>
            <!-- PHONE -->
            <div class="-intro-x flex flex-col md:ml-3">
                <label class="-intro-x text-white" for="Phone"> {{__('Phone')}}:</label>
                <input id="Phone" class="-intro-x  form-control py-3" type="number" wire:model="Workphone"
                        :value="old('Phone')"  autofocus />
            </div>
        </div> 
        <div class="flex flex-col mt-3">
            <input id="Email" class="-intro-x  form-control py-3" type="Email" wire:model="Email"
                    :value="old('Email')" required autofocus placeholder={{__('Email')}} />
                    @error('Email') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                        <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                    </div>  @enderror
        </div>
        <div class="flex flex-col mt-3">
            <input id="confirmEmail" class="-intro-x  form-control py-3" type="email" wire:model="confirmEmail"
                    :value="old('confirmEmail')" required autofocus placeholder="{{__('Confirm Email')}}"/>
                    @error('confirmEmail') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                        <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                    </div>  @enderror
        </div>  
            
        <span class="-intro-x  text-white font-bold uppercase text-lg">{{__('LOCATION DATA')}}:</span>  
        <div class="w-full mt-2">
            <div class="flex flex-col">
                <label class="-intro-x text-white"  for="Address"> 
                        {{__('Address')}}:
                </label>
                <input placeholder="{{__('Address')}}" id="Address" class="-intro-x  form-control py-3" type="text" wire:model="Address" :value="old('Address')" required autofocus />
            </div>           
        </div>
        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="flex flex-col mt-3 md:mt-0">
                <label class="text-white" for="Country">
                    {{__('Country')}}
                </label>
                <input id="Country" class="-intro-x  form-control py-3" type="text" wire:model="Country"
                        :value="old('Country')" required autofocus />
            </div>
            <!-- State/Province -->
            <div class="flex flex-col md:ml-3">
                <label class="text-white" for="State"> {{__('State')}}:</label>
                <input id="State" class="-intro-x  form-control py-3" type="text" wire:model="State"
                        :value="old('State')" required autofocus />
            </div>
        </div>

        <div class="-intro-x grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="flex flex-col">
                <label class="text-white" for="City"> {{__('City')}}:</label>
                <div class="flex text-xl gap-2 items-center">
                    <input id="City" class="-intro-x  form-control py-3" type="text" wire:model="City"
                        :value="old('City')" required autofocus />
                </div>
            </div>
            <!-- Zip -->
            <div class="flex flex-col md:ml-3">
                <label class="text-white" for="ZipCode">{{__('ZipCode')}}:</label>
                    <input id="ZipCode" class="-intro-x  form-control py-3" type="text" wire:model="ZipCode"
                        :value="old('ZipCode')" required autofocus />

            </div>
        </div>
        <div class="w-full p-3">
            <input type="checkbox" class="-intro-x bg-white " style=" input:checked {
                background-color:green;
            }" wire:model="terminos">
            <span class="text-white">{{__('Accept to')}} <button onclick="terminos()">{{__('Terms and Conditions')}}</button> </span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button 
                @if ($terminos==false)
                    disabled
                @else 
                @endif
            class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" wire:click="create()">
               {{__('Register')}}
            </button>
            <a class="intro-x login__input underline text-sm text-white hover:text-gray-900 mr-3" href="{{ route('login') }}">
                Ya estas registrado?
            </a>
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
                'Good job!',
                event.detail.msg,
                'success'
                ).then(result => {
                    if(result.isConfirmed){
                        window.location = '/login'
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
</div>

    
   
               
                
    

        
        
     
               
              