  
<div  x-data @click.outside="show = false" class="absolute max-h-[550px] px-4 shadow-lg py-3 z-50 inset-x-0 mx-auto  mt-[50px] max-w-lg border bg-gray-50 rounded-lg overflow-x-auto">
    <form 
        wire:submit="save" 
        class="overflow-x-auto relative"
        >

        <x-close-modal-icon class="absolute right-0 top-0"/>
        <div>
            <div class="border-b border-gray-300 w-full pb-2">

                <span class="text-md">Policy Information</span>
            </div>
            <div class="flex flex-col mt-3">
                <div class="mb-2 flex flex-col">
                    <x-form-input-label class="text-sm mb-1">Policy name</x-form-input-label>
                    <x-form-input wire:model="name" ></x-form-input>
                    <x-error error="name"/>
                </div>      

                <div class="mb-3 flex flex-col space-y-1">
                    <label class="text-xs font-sm">Policy Type</label>
                    <select  error='form.policyId' wire:model='policyType'  wire:change="selectPolicyType($event.target.value)"  class="px-2 py-1 text-xs  border rounded text-gray-500 border-gray-300" name="" id="">
                        <option value="">Select Here</option>  
                        <option value="Non-life-type">Non-Life Policy</option> 
                        <option value="Life Policy">Life Policy</option>            
                    </select>
                    <x-error error="policyType"/>
                </div>

                <div class="mb-2 flex flex-col">
                    <x-form-input-label class="text-sm mb-1">Quantity</x-form-input-label>
                    <x-form-input wire:model="quantity"></x-form-input>
                    <x-error error="quantity"/>
                </div>       
            </div>
            

            <div class="border border-gray-300 w-full my-5"></div>

            @if($selectedType == 'Non-life-type')
            <div>

                <div class="grid grid-cols-2 space-x-2">
                    <div class="mb-2 flex flex-col">
                        <x-form-input-label class="text-sm mb-1">Limit Liability</x-form-input-label>
                        <x-form-input wire:model="limitLiability"  ></x-form-input>
                        <x-error error="limitLiability"/>
                    </div>     
                    <div class="mb-2  flex flex-col">
                        <x-form-input-label class="text-sm mb-1">Premium Paid</x-form-input-label>
                        <x-form-input wire:model="premiumPaid"  ></x-form-input>
                        <x-error error="premiumPaid"/>
                    </div>
                </div>
            
                <div class="grid grid-cols-2 space-x-2">
                    <div class="mb-2 flex flex-col">
                        <x-form-input-label class="text-sm mb-1">Premium</x-form-input-label>
                        <x-form-input wire:model="premium"  ></x-form-input>
                        <x-error error="premium"/>
                    </div>     
                    <div class="mb-2  flex flex-col">
                        <x-form-input-label class="text-sm mb-1">Docstamp</x-form-input-label>
                        <x-form-input wire:model="govTax"  ></x-form-input>
                        <x-error error="govTax"/>
                    </div>
                </div>
                <div class="grid grid-cols-2 space-x-2">
                    <div class="mb-2 flex flex-col">
                        <x-form-input-label class="text-sm mb-1">Goverment Stamp</x-form-input-label>
                        <x-form-input wire:model="docstamp"  ></x-form-input>
                        <x-error error="docstamp"/>
                    </div>     
                    <div class="mb-2  flex flex-col">
                        <x-form-input-label class="text-sm mb-1">Others</x-form-input-label>
                        <x-form-input wire:model="others"  ></x-form-input>
                        <x-error error="others"/>
                    </div>
                </div>
                    
            </div>
            @endIf
        </div>
    
        <div class="flex justify-center mt-2">
            <x-button class="text-sm">Save</x-button>
        </div>
    </form>
</div>