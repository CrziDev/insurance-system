<div class="absolute px-4 py-3 inset-x-0 mx-auto mt-[10%] max-w-4xl border bg-white rounded-lg">
   <div class="w-full overflow-x-auto flex justify-between flex-col relative">
      <div class="mb-5">
         <p class="text-sm  text-{{lcfirst($transactions->status_description)}} font-semibold"> {{$transactions->status_description}} Application</p>         
      </div>
      <x-close-modal-icon :modal="$modal" class="absolute right-0 top-0"/>
      <div class="flex flex-col border px-3 rounded-md mb-2 pb-3 ">
         <div class="flex align-center space-x-2 border-b py-3 justify-between">
               <div class="flex space-x-2">
                  <img class="w-[28px] h-[23px]" src="{{Vite::asset('resources/images/insurance1.png')}}" alt="">
                  <div class="flex flex-col space-y-1">
                     <p class="text-sm font-bold">{{$transactions->policy->name}}</p>
                  </div>   
               </div>
               <div class="flex space-x-5">

                  <div class="flex space-x-2 align-center ">
                     <p class="text-xs">Effective:</p>
                     <p class="text-xs font-semibold">{{$transactions->date_effect_format??'N/A'}}</p>
                  </div>     
                  <div class="flex space-x-2 align-center ">
                     <p class="text-xs">Expiration:</p>
                     <p class="text-xs font-semibold">{{$transactions->date_expiration_format??'N/A'}}</p>
                  </div>                       
               </div>
         </div>
         <div class="flex align-center text-center space-x-2 justify-evenly py-4">
            <div class="w-[30%] border-r ">
                  <p class="text-sm mb-1">Client</p>
                  <p class="text-xl font-semibold">{{$transactions->user->customer[0]->full_name}}</p>
               </div>
               <div class="w-[30%] border-r ">
                  <p class="text-sm mb-1">Premium</p>
                  <p class="text-xl font-semibold">₱250/month</p>
               </div>
               <div class="w-[40%] border-r">
                  <p class="text-sm mb-1">Duration</p>
                  <p class="font-semibold">{{$transactions->duration??null}}</p>
               </div>

               @if($transactions->status != 1)
                  @if($transactions->status == 2)
                  <div class="w-[40%] border-r">
                     <p class="text-sm mb-1">Action</p>
                     <x-button class="bg-orange" wire:click="selectedRow({{$transactions}})">Renew</x-button>
                  </div>
                  @else
                     <div class="w-[40%] border-r">
                        <p class="text-sm mb-1">Action</p>
                        <x-button wire:click="selectedRow({{$transactions}})">View</x-button>
                     </div>
                  @endif
               @endif
         </div>
      </div>  
    </div>   

    <x-modal-child name="view-insurance">   
        @if($transactions)

            @if($this->transactions->policy->type == "Non-life-type")
               <livewire:update-non-life-insurance-form modal="-child" :selectedRow="$transactions" :policyId="$transactions->type_id" />    
            @endif

            @if($this->transactions->policy->type == "Life Policy")
               <livewire:update-life-insurance-form :selectedRow="$transactions" key="{{ $transactions->id }}"/>   
            @endif

         @endif
    </x-modal-child>



</div>
