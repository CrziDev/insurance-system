@props(['editable' => true])
<div class="absolute px-4 py-3 inset-x-0 mx-auto  mt-[10px] max-w-5xl border  bg-white rounded-lg h-[90%] overflow-x-auto">
    <form 
        wire:submit="update" 
        class="overflow-x-auto relative"

        >
        <span class="mb-5 font-2lg text-xl block text-center ">Life Insurance Policy Application</span>
        <x-close-modal-icon :modal='$modal' class="absolute right-0 top-0"/>
    
        <div class="grid grid-cols-2 gap-5">
            <x-form-card>
                <x-slot:title>
                    Total Protection Package
                </x-slot:title>      

                <div class="flex items-center text-sm space-x-2 justify-center">                  
                    <div class="flex items-center">
                        <input 
                        disabled="!$editable"

                            type="checkbox"
                            value="Economy" 
                            wire:change="selectPackage($event.target.value)" 
                            class="w-[20px] h-[100%] accent-lime-200"
                            @if(in_array('Economy', $form->protection_package)) checked @endif>
                            
                        <label for="" class="">Economy</label>
                    </div>   
                    <div class="flex items-center">
                        <input type="checkbox"
                        disabled="!$editable"
                            value="Premiere"
                            wire:change="selectPackage($event.target.value)"
                            class="w-[20px] h-[100%] accent-lime-200"
                            @if(in_array('Premiere', $form->protection_package)) checked @endif>
                            
                        <label for="" class="">Premiere</label>
                    </div>     
                    <div class="flex items-center">
                        <input type="checkbox" 
                        disabled="!$editable"
                        wire:model="form.protection_package" 
                         value="Deluxe"
                         wire:change="selectPackage($event.target.value)" 
                         class="w-[20px] h-[100%] accent-lime-200"
                         @if(in_array('Deluxe', $form->protection_package)) checked @endif>
                         
                        <label for="" class="">Deluxe</label>
                    </div>                 
                </div>

                @error('form.protection_package')<span class="text-xs text-red-500">Field is required</span>@enderror

            
            </x-form-card>
            <x-form-card>
                <x-slot:title>
                    Total Protection Package
                </x-slot:title>   
                
                
                <div class="flex items-center text-sm space-x-2 justify-center">                  
                    <div class="flex items-center">
                        <input type="checkbox" 
                            value="Standard" 
                            disabled="!$editable"
                            wire:model="form.allowance_package" 
                            wire:change="allowancePackage($event.target.value)" c
                            class="w-[20px] h-[100%] accent-lime-200"  
                            @if(in_array('Standard', $form->allowance_package)) checked @endif>
                        <label for="" class="">Standard</label>
                    </div>   
                    <div class="flex items-center">
                        <input type="checkbox"
                        disabled="!$editable"
                         value="Superior"
                          wire:change="allowancePackage($event.target.value)"
                           class="w-[20px] h-[100%] accent-lime-200"
                           @if(in_array('Superior', $form->allowance_package)) checked @endif>
                        <label for="" class="">Superior</label>
                    </div>                     
                </div>
                @error('form.allowance_package')<span class="text-xs text-red-500">Field is required</span>@enderror

            </x-form-card>
        </div>


        <x-form-card>
                <x-slot:title>
                    Policy Type
                </x-slot:title>   
                <div class="flex flex-col space-y-1">
                    <label class="text-xs font-sm">Select a Policy Type</label>
                    <select  disabled="!$editable" error='form.policyId' wire:model='form.policyId' class="px-2 py-1 text-xs  border rounded text-gray-500" name="" id="">
                        <option value="">Select Here</option>  
                        @foreach($policyLists as $policy)
                            <option  wire:key="{{$policy->id}}" value="{{$policy->id}}" {{($policy->id == $form->policyId)?'selected':''}}>{{$policy->name}}</option>
                        @endforeach
                    </select>
                    @error('form.policyId')<span class="text-xs text-red-500">Field is required</span>@enderror
                </div>
        </x-form-card>
        
        <x-form-card>
            <x-slot:title>
                Personal Information
            </x-slot:title>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label readonly error='form.full_name' wire:model="form.full_name">Full name</x-form-input-w-label>
                <x-form-input-w-label readonly error='form.mobile_number' wire:model="form.mobile_number">Mobile number</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label disabled="!$editable" readonly error='form.email_address' wire:model="form.email_address">Email Address</x-form-input-w-label>
                <x-form-input-w-label disabled="!$editable" error='form.telephone_number' wire:model="form.telephone_number">Telephone Number.</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label disabled="!$editable" type="date" error='form.date_of_birth' wire:model="form.date_of_birth">Date of Birth:</x-form-input-w-label>
                <x-form-input-w-label disabled="!$editable" error='form.place_of_birth' wire:model="form.place_of_birth">Place of Birth</x-form-input-w-label>
            </div>


            <div class="grid grid-cols-1 gap-5">
                <x-form-input-w-label disabled="!$editable" error='form.nationality' wire:model="form.nationality">Nationality:</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label disabled="!$editable" error='form.name_of_beneficiary' wire:model="form.name_of_beneficiary">Name of Beneficiary:</x-form-input-w-label>
                <x-form-input-w-label disabled="!$editable" error='form.name_of_trustee' wire:model="form.name_of_trustee">Name of Trustee, if beneficiary is minor:</x-form-input-w-label>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label disabled="!$editable" error='form.tin' wire:model="form.tin">TIN:</x-form-input-w-label>
                <x-form-input-w-label disabled="!$editable" error='form.other_id' wire:model="form.other_id">Other ID.
                (SSS/GSIS, if TIN is unavailable)</x-form-input-w-label>
            </div>
            <div class="grid grid-cols-2 gap-5">

                <div>
                    <div class="flex flex-col space-y-1">
                        <label class="text-xs font-sm">Gender</label>
                        <select  @if(!$editable) readonly @endif wire:model="form.gender"  class="px-2 py-1 text-xs  border rounded text-gray-500" name="" id="">
                            <option value="">Select Here</option>  
                                <option  value="Male" {{($form->gender == 'Male')? 'selected':''}}>Male</option>
                                <option  value="Female" {{($form->gender == 'Male')? 'selected':''}}>Female</option>   
                        </select>
                        @error('form.gender')<span class="text-xs text-red-500">Field is required</span>@enderror
                    </div>
                </div>

                <div>
                    <div class="flex flex-col space-y-1">
                        <label class="text-xs font-sm">Civil status</label>
                        <select @if(!$editable) readonly @endif wire:model="form.civil_status"  class="px-2 py-1 text-xs  border rounded text-gray-500" name="" id="">
                            <option value="">Select Here</option>  
                                <option  value="Single" {{($form->civil_status == 'Single')? 'selected':''}}>Single</option>
                                <option  value="Widowed" {{($form->civil_status == 'Widowed')? 'selected':''}}>Married</option>
                                <option  value="Widowed" {{($form->civil_status == 'Widowed')? 'selected':''}}>Widowed</option>   
                                <option  value="Separated" {{($form->civil_status == 'Separated')? 'selected':''}}>Separated</option>   

                        </select>
                        @error('form.gender')<span class="text-xs text-red-500">Field is required</span>@enderror
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label disabled="!$editable" error='form.permanent_official_mail_address' wire:model="form.permanent_official_mail_address">Permanent/Official Mailing Address:
                    (leave blank if same with Present/Business Address)</x-form-input-w-label>
                <x-form-input-w-label disabled="!$editable" error='form.occupation' wire:model="form.occupation">Occupation</x-form-input-w-label>
                <x-form-input-w-label disabled="!$editable" error='form.source_of_funds' wire:model="form.source_of_funds">Source of Funds:</x-form-input-w-label>

            </div>

        </x-form-card>

        <x-form-card>
                <x-slot:title>
                    Additional Information
                </x-slot:title>
                <div class="grid grid-cols-2 gap-5">
                    <x-form-input-w-label disabled="!$editable" type="date" error='dateEffective' wire:model="dateEffective">Period of Issuance</x-form-input-w-label>
                    <x-form-input-w-label disabled="!$editable" type="date" error='expiration' wire:model="expiration">Effective Until</x-form-input-w-label>
                 </div>
        </x-form-card>


        
        @if($status == 2 && request()->user()->role != 3)
        <div class="flex justify-center">
            <x-button>Renew Insurance</x-button>
        </div>
        @endif


        @if($status == 4 && request()->user()->role != 3)
        <div class="flex justify-center">
            <x-button>Approve Insurance</x-button>
        </div>
        @endif
    
    </form>
</div>