
<div class=" h-[90%] overflow-x-auto">
<form action="" class="overflow-x-auto">
    <span class="mb-5 font-2lg text-xl block text-center ">Non-life Insurance Policy Application</span>
    <x-form-card>
        <x-slot:title>
            Personal Information
        </x-slot:title>
        <div class="grid grid-cols-2 gap-5">
            <x-form-input-w-label wire:model="firstName">First Name</x-form-input-w-label>
            <x-form-input-w-label>Last Name</x-form-input-w-label>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <x-form-input-w-label>Address</x-form-input-w-label>
            <x-form-input-w-label>Business Profession</x-form-input-w-label>
        </div>
    </x-form-card>

    <x-form-card>
        <x-slot:title>
            Scheduled Vehicle
        </x-slot:title>
        <div class="grid grid-cols-3 gap-5">
            <x-form-input-w-label>Model</x-form-input-w-label>
            <x-form-input-w-label>Plate No.</x-form-input-w-label>
            <x-form-input-w-label>Make</x-form-input-w-label>
        </div>

        <div class="grid grid-cols-3 gap-5">
            <x-form-input-w-label>Serial/Chassis No</x-form-input-w-label>
            <x-form-input-w-label>Type of Body</x-form-input-w-label>
            <x-form-input-w-label>Color</x-form-input-w-label>
        </div>

        <div class="grid grid-cols-3 gap-5">
            <x-form-input-w-label>Authorized Capacity</x-form-input-w-label>
            <x-form-input-w-label>Blt File No.y</x-form-input-w-label>
            <x-form-input-w-label>Unladen Weight (kgs.)</x-form-input-w-label>
        </div>
    </x-form-card>

    <x-form-card>
        <x-slot:title>
            Policy Type
        </x-slot:title>
        <div class="flex flex-col space-y-1">
            <label class="text-xs font-sm">Select a Policy</label>
            <select class="px-2 py-1 text-xs  border rounded text-gray-500" name="" id="">
                <option value="" selected>Select Here</option>
                <option value="">Motorcycle</option>
                <option value="">Truck</option>
            </select>
        </div>

        <div class="w-full h-[.5px] bg-gray-400/50 my-2"></div>
        <div class="grid grid-cols-2">
            <div>
                <div class="mb-2">
                    <x-form-input-label class="w-[100px]">Limit of Liability</x-form-input-label>
                    <x-form-input></x-form-input>
                </div>
                <div class="mb-2">
                    <x-form-input-label class="w-[100px]">Premium Paid</x-form-input-label>
                    <x-form-input></x-form-input>
                </div>
            </div>

            <div>
                <div class="mb-2">
                    <x-form-input-label class="w-[100px]">Premium Paid</x-form-input-label>
                    <x-form-input></x-form-input>
                </div>
                <div class="mb-2">
                    <x-form-input-label class="w-[100px]">Doc. Stamps</x-form-input-label>
                    <x-form-input></x-form-input>
                </div>
                <div class="mb-2">
                    <x-form-input-label class="w-[100px]">Local Gov't Tax</x-form-input-label>
                    <x-form-input></x-form-input>
                </div>
                <div class="mb-2">
                    <x-form-input-label class="w-[100px]">Others</x-form-input-label>
                    <x-form-input></x-form-input>
                </div>
                <div class="mb-2">
                    <x-form-input-label class="w-[100px] !font-bold">Total</x-form-input-label>
                    <x-form-input></x-form-input>
                </div>
            </div>
        </div>
    </x-form-card>

    <div class="flex justify-center">
        <x-button>Submit</x-button>
    </div>

</form>
</div>