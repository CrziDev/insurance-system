  
<div class="absolute px-4 py-3 inset-x-0 mx-auto  mt-[10px] max-w-5xl border bg-white rounded-lg h-[90%] overflow-x-auto">
    <form 
        wire:submit="save" 
        class="overflow-x-auto relative"

        >
        <span class="mb-5 font-2lg text-xl block text-center ">Non-life Insurance Policy Applications</span>
        <x-close-modal-icon :modal="$modal" class="absolute right-0 top-0"/>
        <x-form-card>
            <x-slot:title> 
                Personal Information
            </x-slot:title>

            
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.firstName' disabled wire:model="form.firstName">First Name</x-form-input-w-label>
                <x-form-input-w-label error='form.lastName' disabled wire:model="form.lastName">Last Name</x-form-input-w-label>

            </div>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.address' disabled wire:model="form.address">Address</x-form-input-w-label>
                <x-form-input-w-label error='form.businessProfession' disabled wire:model="form.businessProfession">Business Profession</x-form-input-w-label>
            </div>
        </x-form-card>
        <x-form-card>
            <x-slot:title>
                Scheduled Vehicle
            </x-slot:title>
            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.model' wire:model="form.model" placeholder="Input Model" oninput="this.value=this.value.replace(/[^0-9]/g,'')">Model</x-form-input-w-label>
                <x-form-input-w-label error='form.plateNo' wire:model="form.plateNo" placeholder="Input Plate No.">Plate No.</x-form-input-w-label>
                <x-form-input-w-label error='form.make' wire:model="form.make" placeholder="Input Make">Make</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.serialChassis' wire:model="form.serialChassis" placeholder="Input Serial/Chassis No"   oninput="this.value=this.value.replace(/[^A-Za-z0-9\/\-\_\.\s]/g,'')">Serial/Chassis No</x-form-input-w-label>
                <x-form-input-w-label error='form.typeBody' wire:model="form.typeBody" placeholder="Type of Body">Type of Body</x-form-input-w-label>
                <x-form-input-w-label error='form.color' wire:model="form.color" placeholder="Input Color">Color</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.authorizedCapacity' wire:model="form.authorizedCapacity" placeholder="Input Authorized Capacity">Authorized Capacity</x-form-input-w-label>
                <x-form-input-w-label error='form.bltFileNo' wire:model="form.bltFileNo" placeholder="Input Blt File No.y" oninput="this.value=this.value.replace(/[^0-9\-_\.]/g,'')" >Blt File No.y</x-form-input-w-label>
                <x-form-input-w-label error='form.weightCapacity'  wire:model="form.weightCapacity" placeholder="Unladen Weight (kgs.)">Unladen Weight (kgs.)</x-form-input-w-label>
            </div>
            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.motoNum' wire:model="form.motoNum" placeholder="Input Motor No.">Moto No.</x-form-input-w-label>
            </div>
        </x-form-card>

        
        
        <x-form-card>
            <x-slot:title>
                Policy Type
            </x-slot:title>
            <div class="flex flex-col space-y-1">
                <label class="text-xs font-sm">Select a Policy</label>
                <select  error='form.policyId' wire:model='policyId'  wire:change="selectOptions($event.target.value)"  class="px-2 py-1 text-xs  border rounded text-gray-500" name="" id="">
                    <option value="">Select Here</option>  
                    @foreach($policyLists as $policy)
                        <option  wire:key="{{$policy->id}}" value="{{$policy->id}}" {{($policy->id == $form->policyId)?'selected':''}}>{{$policy->name}}</option>
                    @endforeach
                </select>
                @error('form.policyId')<span class="text-xs text-red-500">Field is required</span>@enderror
            </div>

            <div class="w-full h-[.5px] bg-gray-400/50 my-2"></div>
            <div class="grid grid-cols-2">
                <div>
                    <div class="mb-2">
                        <x-form-input-label  class="w-[100px]">Limit of Liability</x-form-input-label>
                        <x-form-input readonly value="{{$limitLiability}}" ></x-form-input>
                    </div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px]">Premium Paid</x-form-input-label>
                        <x-form-input readonly value="{{$premiumPaid}} "></x-form-input>
                    </div>
                </div>

                <div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px]">Premium</x-form-input-label>
                        <x-form-input readonly value="{{$premium}}"></x-form-input>
                    </div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px]">Doc. Stamps</x-form-input-label>
                        <x-form-input readonly value="{{$docstamp}}"></x-form-input>
                    </div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px]">Local Gov't Tax</x-form-input-label>
                        <x-form-input readonly value="{{$localGovTax}}"></x-form-input>
                    </div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px]">Others</x-form-input-label>
                        <x-form-input readonly value="{{$others}}"></x-form-input>
                    </div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px] !font-bold" >Total</x-form-input-label>
                        <x-form-input readonly value="{{$total}}"></x-form-input>
                    </div>
                </div>
            </div>
        </x-form-card>
        <x-form-input hidden wire:model="userId"></x-form-input>

        @if(request()->user()->role != 3)
        <div class="grid grid-cols-1">
                <div>
                    <div class="mb-2">
                        <x-form-input-label  class="mr-1">Forms and Endorsements Made Part of this Policy at time of Issue</x-form-input-label>

                        <select  error='form.form_endorsement' wire:model='form_endorsement' class="px-2 py-1 text-xs  border rounded text-gray-500" name="" id="">
                            <option value="">Select Here</option>  
                                <option value="NOTE FOR TPL ONLY...">NOTE FOR TPL ONLY... </option>
                                <option value="NOTE FOR CTPL ONLY...">NOTE FOR CTPL ONLY... </option>
                        </select>
                    </div>
                </div>
        </div>
        @endif

            
        <div class="flex justify-center">
            <x-button>Submit Request</x-button>
        </div>

    </form>
</div>