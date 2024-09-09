@props(['nonLifeInsurance'=>'[]'])
<div class="bg-white px-4 py-5 rounded-lg shadow-md w-full h-[400px] pb-5">
    <div class="flex justify-between mb-5">
        <x-table-title>Recent Events</x-table-title>
        <x-table-link link="/customer/insurance">See more</x-table-link> 
    </div>
    <div class="w-full h-[300px] overflow-x-auto flex justify-between flex-col">
        @foreach($nonLifeInsurance->slice(0,5) as $insurance)
        <div class="flex items-center border px-3 rounded-md mb-2 py-3">
                <div class="w-full">
                    <div class="flex align-center space-x-2">
                        <img class="w-[28px] h-[23px]" src="{{Vite::asset('resources/images/insurance1.png')}}" alt="">
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm font-semibold">Motorcycle Policy</p>
                        </div>   
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex flex-col space-y-1">
                        <p class="text-xs  text-green-600 font-sm text-center">Request Submitted</p>
                    </div>   
                </div>
                <div class="w-full">
                    <div class="flex flex-col space-y-1">
                        <p class="text-xs font-sm text-center">July 28, 2000</p>
                    </div>   
                </div>
        
            </div>  
        @endforeach         
    </div>    
</div>