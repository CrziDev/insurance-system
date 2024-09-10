  
<div class="absolute px-4 py-3 inset-x-0 mx-auto  mt-[10px] max-w-5xl border  bg-white rounded-lg h-[90%] overflow-x-auto">
    <form 
        wire:submit="save" 
        class="overflow-x-auto relative"

        >
        <span class="mb-5 font-2lg text-xl block text-center ">Life Insurance Policy Application</span>
        <x-close-modal-icon class="absolute right-0 top-0"/>

        <div class="grid grid-cols-2 gap-5">
            <x-form-card>
                <x-slot:title>
                    Total Protection Package
                </x-slot:title>      
            
            </x-form-card>
            <x-form-card>
                <x-slot:title>
                    Total Protection Package
                </x-slot:title>      
            </x-form-card>
        </div>
        <x-form-card>
            <x-slot:title>
                Personal Information
            </x-slot:title>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.full_name' wire:model="form.full_name">Full name</x-form-input-w-label>
                <x-form-input-w-label error='form.mobile_number' wire:model="form.mobile_number">Mobile number</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.email_address' wire:model="form.email_address">Email Address</x-form-input-w-label>
                <x-form-input-w-label error='form.telephone_number' wire:model="form.telephone_number">Telephone Number.</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.date_of_birth' wire:model="form.date_of_birth">Date of Birth:</x-form-input-w-label>
                <x-form-input-w-label error='form.place_of_birth' wire:model="form.place_of_birth">Place of Birth</x-form-input-w-label>
            </div>


            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.nationality' wire:model="form.nationality">Nationality:</x-form-input-w-label>
                <x-form-input-w-label error='form.telephone_number' wire:model="form.telephone_number">Email Address:</x-form-input-w-label>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.name_of_beneficiary' wire:model="form.name_of_beneficiary">Name of Beneficiary:</x-form-input-w-label>
                <x-form-input-w-label error='form.name_of_trustee' wire:model="form.name_of_trustee">Name of Trustee, if beneficiary is minor:</x-form-input-w-label>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.tin' wire:model="form.tin">TIN:</x-form-input-w-label>
                <x-form-input-w-label error='form.other_id' wire:model="form.other_id">Other ID.
                (SSS/GSIS, if TIN is unavailable)</x-form-input-w-label>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <x-form-input-w-label error='form.gender' wire:model="form.gender">Gender:</x-form-input-w-label>
                <x-form-input-w-label error='form.civil_status' wire:model="form.civil_status">Civil Status:</x-form-input-w-label>
            </div>


            <div class="grid grid-cols-3 gap-5">
                <x-form-input-w-label error='form.permanent_official_mail_address' wire:model="form.permanent_official_mail_address">Permanent/Official Mailing Address:
                    (leave blank if same with Present/Business Address)</x-form-input-w-label>
                <x-form-input-w-label error='form.occupation' wire:model="form.occupation">Occupation</x-form-input-w-label>
                <x-form-input-w-label error='form.source_of_funds' wire:model="form.source_of_funds">Source of Funds:</x-form-input-w-label>

            </div>

        </x-form-card>

    
        <div class="flex justify-center">
            <x-button>Submit Request</x-button>
        </div>

    </form>
</div>