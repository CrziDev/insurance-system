  
<div  x-data @click.outside="show = false" class="absolute max-h-[550px] px-4 shadow-lg py-3 z-50 inset-x-0 mx-auto  mt-[50px] max-w-lg border bg-gray-50 rounded-lg overflow-x-auto">
    <form 
        wire:submit="save" 
        class="overflow-x-auto"
        >
        <div class="text-sm">
            <div class="border-b border-gray-300 w-full pb-2 mb-5">
                    <span class="text-md">Policy Information</span>
            </div>
            <div class="mb-3 flex flex-col space-y-1">
                    <label class="text-xs font-sm">Policy </label>
                    <select   wire:model='policy'  wire:change="selectedPolicy($event.target.value)"  class="rounded-md bg-white border-[3px] px-3 py-3 text-xs   text-gray-500 border-gray-300" name="" id="">
                        <option value="">Select Here</option>  
                        @foreach($policies as $row)
                        <option wire:key="$row->id" value="{{$row->id}}">{{$row->name}}</option> 
                        @endforeach           
                    </select>
                    <x-error error="policy"/>
                </div>

            <div class="h-[35px] flex mb-5 text-sm  flex-col">
                
                <div class="flex">

                    <div
                    class="basis-1/5  bg-gray-700 flex justify-center items-center h-full text-white rounded-tl-md rounded-bl-md text-xs px-2">
                    Quantity</div>
                    
                    
                    <input wire:model="quantity" name="policy_quantity" type="text"
                    class="basis-4/5  h-full border-2 px-3 py-2 rounded-tr-md rounded-br-md active:outline-none focus:outline-none">
                </div>
                <x-error error="policy"/>    
             </div>
            
        <div class="flex justify-center mt-2">
            <x-button class="text-sm">Save</x-button>
        </div>
    </form>
</div>

