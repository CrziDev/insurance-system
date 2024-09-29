
    
<div class="absolute px-4 py-3 inset-x-0 mx-auto mt-[50px] max-w-2xl border bg-white rounded-lg">
    
    <div class="flex justify-between">
        <p class="text-{{lcfirst($client->status_description)}} tex-sm mb-5" >{{$client->status_description}} Application</p>
        <x-close-modal-icon></x-close-modal-icon>
    </div>
            
    <div class="flex">
        <div class="w-[40%] border-r">
            <div class="flex flex-col space-y-5">
                <img class="w-[80px] h-[80px] m-auto rounded-full" src="{{Vite::asset('resources/images/profile.png')}}" alt="">
                
                <div class="flex flex-col space-y-1 ">
                    <p class="text-sm font-bold text-center">{{$client->user->customer[0]->full_name}}</p>
                    <p class="text-xs text-center">Client Name</p>
                </div>
                
                <div class="flex flex-col space-y-1 ">
                    <p class="text-sm font-bold text-center">{{$client->user->customer[0]->profession}}</p>
                    <p class="text-xs  text-center">Client Profession</p>
                </div>   

                <div class="flex flex-col space-y-1 ">
                    <p class="text-sm font-bold text-center text-wrap">{{$client->user->customer[0]->address}}</p>
                    <p class="text-xs  text-center">Address</p>
                </div>   
                
                <div class="flex flex-col space-y-1 ">
                    <p class="text-sm font-bold text-center">{{$client->user->customer[0]->phone_number}}</p>
                    <p class="text-xs  text-center">Contact Info</p>
                </div>   
            </div>
        </div>
        <div class="w-[60%]">   
            <div class="text-center border-b py-3">Private Car Policy</div>
            <div class="px-5 py-2 flex border-b">
                <div class="space-y-5 flex-1">
                    <div>

                        <p class="text-xs">{{$client->nonLifeInsurance->model}}</p>
                        <p class="text-xs">Model</p>
                    </div>
                    
                    <div>
                    <p class="text-xs">{{$client->nonLifeInsurance->make}}</p>
                        <p class="text-xs">Make</p>
                    </div>
                    
                    <div>
                    <p class="text-xs">{{$client->nonLifeInsurance->body_type}}</p>
                        <p class="text-xs  ">Type of body</p>
                    </div>

                    
                    <div>
                        <p class="text-xs">{{$client->nonLifeInsurance->color}}</p>
                        <p class="text-xs  ">Color</p>
                    </div>

                    
                    <div>
                    <p class="text-xs">{{$client->nonLifeInsurance->blt_num}}</p>
                        <p class="text-xs  ">Blt File No</p>
                    </div>
                </div>
                
                <div class="space-y-5 flex-1">
                    <div>
                    <p class="text-xs">{{$client->nonLifeInsurance->plate}}</p>
                        <p class="text-xs">Plate No</p>
                    </div>
                    
                    <div>
                    <p class="text-xs">{{$client->nonLifeInsurance->serial_chassis}}</p>
                        <p class="text-xs  ">Serial/Chassis No</p>
                    </div>
                    
                    <div>
                    <p class="text-xs">N/A</p>
                        <p class="text-xs  ">Motor No</p>
                    </div>
                    <div>
                    <p class="text-xs">{{$client->nonLifeInsurance->authorize_capacity}}</p>
                        <p class="text-xs  ">Authorize Capacity</p>
                    </div>
                    <div>
                    <p class="text-xs">{{$client->nonLifeInsurance->weight_capacity}}</p>
                        <p class="text-xs  ">Unladen Weight (kgs)</p>
                    </div>
                    
                </div>
            </div>

            @if(request()->user()->role != 3  && $client->status == 4)
                <div class="flex justify-center items-center pt-4">
                    <x-button wire:click="showForm()" class="text-sm">Proccess Application</x-button>
                </div>
            @endif

            
        </div>
    </div>
</div>

