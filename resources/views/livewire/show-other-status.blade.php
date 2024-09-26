<div class="absolute px-4 py-3 inset-x-0 mx-auto mt-[10%] max-w-3xl border bg-white rounded-lg">
   <div class="w-full overflow-x-auto flex justify-between flex-col">
         
      <div class="mb-5">
         <p class="text-sm  text-{{lcfirst($data->status_description)}} font-semibold"> {{$data->status_description}} Application</p>         
      </div>
      <div class="flex flex-col border px-3 rounded-md mb-2 pb-3 ">
         <div class="flex align-center space-x-2 border-b py-3 justify-between">
               <div class="flex space-x-2">
                  <img class="w-[28px] h-[23px]" src="{{Vite::asset('resources/images/insurance1.png')}}" alt="">
                  <div class="flex flex-col space-y-1">
                     <p class="text-sm font-bold">{{$data->policy->name}}</p>
                  </div>   
               </div>
               <div class="flex space-x-5">

                  <div class="flex space-x-2 align-center ">
                     <p class="text-xs">Effective:</p>
                     <p class="text-xs font-semibold">{{$data->date_effect_format}}</p>
                  </div>     
                  <div class="flex space-x-2 align-center ">
                     <p class="text-xs">Expiration:</p>
                     <p class="text-xs font-semibold">{{$data->date_expiration_format}}</p>
                  </div>                       
               </div>
         </div>
         <div class="flex align-center text-center space-x-2 justify-evenly py-4">
            <div class="w-[30%] border-r ">
                  <p class="text-sm mb-1">Client</p>
                  <p class="text-xl font-semibold">{{$data->user->customer[0]->full_name}}</p>
               </div>
               <div class="w-[30%] border-r ">
                  <p class="text-sm mb-1">Premium</p>
                  <p class="text-xl font-semibold">₱250/month</p>
               </div>
               <div class="w-[40%] border-r">
                  <p class="text-sm mb-1">Duration</p>
                  <p class="font-semibold">{{$duration}}</p>
               </div>
         </div>
      </div>  
    </div>   
</div>
