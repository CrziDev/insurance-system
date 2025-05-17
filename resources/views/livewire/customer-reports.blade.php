<div class="h-[500px]">
   <div class="flex justify-between items-center mb-4 border-b pb-2">
        <x-table-title class="text-sm">{{$tableTitle}}</x-table-title>
        <div class="pl-2 bg-white items-center  text-xs">
            <div >
                <select wire:model='year' wire:change="yearSelect($event.target.value)"  class="focus:outline-none" name="" id="">
                        <option value="">Select Here</option>  
                        <option value="2020">2020</option>
                        <option value="2021" >2021</option>
                        <option value="2022" >2022</option>
                        <option value="2023" >2023</option>
                        <option value="2024" >2024</option>    
                        <option value="2025" >2025</option>    

                </select>
            </div>
        </div>
        <div class=" bg-white items-center  text-xs">
            <div >
                <select wire:change="monthSelect($event.target.value)" class="focus:outline-none reportsApprovedTable" name="selectedMonth" >
                <option value="" >All</option>
                <option value="1" >January</option>
                <option value="2" >February</option>
                <option value="3" >March</option>
                <option value="4" >April</option>
                <option value="5" >May</option>
                <option value="6" >June</option>
                <option value="7" >July</option>
                <option value="8" >August</option>
                <option value="9" >September</option>
                <option value="10" >October</option>
                <option value="11" >November</option>
                <option value="12" >December</option>
                </select>
            </div>
        </div>
   </div>

   <div class="h-[90%] flex flex-col justify-between">
       <div class="overflow-x-auto">
        @foreach($data as $row)
        <div class="flex items-center border px-3 rounded-md mb-2 py-3">
                    <div class="w-full">
                        <div class="flex align-center space-x-2">
                            <img class="w-[28px] h-[23px]" src="{{Vite::asset('resources/images/insurance1.png')}}" alt="">
                            <div class="flex flex-col space-y-1">
                                <p class="text-xs font-semibold">{{$row->user->customer[0]?->full_name}}</p>
                                <p class="text-xs font-semibold">{{$row->created_at_format}}</p>
                            </div>   
                        </div>
                    </div>
    
                    <div class="w-full">
                        <div class="flex flex-col space-y-1">
                            <p class="text-xs  font-sm text-center">{{$row->policy->name}}</p>
                        </div>   
                    </div>
                </div>  
                @endforeach
        </div>
    
        <div class="flex justify-end">
            <x-button class="text-sm" wire:click="printSales()">
                Print
            </x-button>
        </div>

   </div>

   

</div>
