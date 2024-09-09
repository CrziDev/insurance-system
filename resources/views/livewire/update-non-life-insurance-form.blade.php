  
<div class="absolute px-4 py-3 inset-x-0 mx-auto  mt-[10px] max-w-5xl border bg-white rounded-lg h-[90%] overflow-x-auto">
    <form 
        wire:submit="update" 
        class="overflow-x-auto relative"
        >
        <span class="mb-5 font-2lg text-xl block text-center ">Non-life Insurance Policy Application</span>
        <x-close-modal-icon class="absolute right-0 top-0"/>
        
        <x-form-card>
            <x-slot:title>
                Personal Information
            </x-slot:title>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.firstName' value="ss" wire:model="form.firstName">First Name</x-form-input-w-label>
                <x-form-input-w-label error='form.lastName' wire:model="form.lastName">Last Name</x-form-input-w-label>

            </div>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.address' wire:model="form.address">Address</x-form-input-w-label>
                <x-form-input-w-label error='form.businessProfession' wire:model="form.businessProfession">Business Profession</x-form-input-w-label>
            </div>
        </x-form-card>
        <x-form-card>
            <x-slot:title>
                Scheduled Vehicle
            </x-slot:title>
            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.model' wire:model="form.model">Model</x-form-input-w-label>
                <x-form-input-w-label error='form.plateNo' wire:model="form.plateNo">Plate No.</x-form-input-w-label>
                <x-form-input-w-label error='form.make' wire:model="form.make">Make</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.serialChassis' wire:model="form.serialChassis">Serial/Chassis No</x-form-input-w-label>
                <x-form-input-w-label error='form.typeBody' wire:model="form.typeBody">Type of Body</x-form-input-w-label>
                <x-form-input-w-label error='form.color' wire:model="form.color">Color</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.authorizedCapacity' wire:model="form.authorizedCapacity">Authorized Capacity</x-form-input-w-label>
                <x-form-input-w-label error='form.bltFileNo' wire:model="form.bltFileNo">Blt File No.y</x-form-input-w-label>
                <x-form-input-w-label error='form.weightCapacity'  wire:model="form.weightCapacity">Unladen Weight (kgs.)</x-form-input-w-label>
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
                        <x-form-input error='form.limitLiabity' wire:model="form.limitLiabity"></x-form-input>
                    </div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px]">Premium Paid</x-form-input-label>
                        <x-form-input error='form.premiumPaidOnlimit' wire:model="form.premiumPaidOnlimit"></x-form-input>
                    </div>
                </div>

                <div>
                    <div class="mb-2">
                        <x-form-input-label class="w-[100px]">Premium Paid</x-form-input-label>
                        <x-form-input readonly value="{{$premiumPaid}}"></x-form-input>
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

        <x-form-card>
                <x-slot:title>
                    Additional Information
                </x-slot:title>
                <div class="grid grid-cols-2 gap-5">
                    <x-form-input-w-label type="date" error='form.dateEffective' wire:model="form.dateEffective">Period of Issuance</x-form-input-w-label>
                    <x-form-input-w-label type="date" error='form.expiration' wire:model="form.expiration">Effective Until</x-form-input-w-label>
                    <x-form-input-w-label error='form.confirmation_no' wire:model="form.confirmation_no">Confirmation of Cover No.</x-form-input-w-label>
                    <x-form-input-w-label error='form.official_receipt' wire:model="form.official_receipt">Official Receipt No.</x-form-input-w-label>            

                </div>
        </x-form-card>

        @if($selectedRow->status == 4)
        <div class="flex justify-center">
            <x-button>Approve Request</x-button>
        </div>
        @endif

    </form>
</div>