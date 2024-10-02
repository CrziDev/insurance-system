  
<div x-data @click.outside="show = false"  class="absolute max-h-[550px] px-4 shadow-lg py-3 z-50 inset-x-0 mx-auto  mt-[50px] max-w-lg border bg-gray-50 rounded-lg overflow-x-auto">
    <form 
        wire:submit="update" 
        class="overflow-x-auto relative"
        >

        <x-close-modal-icon class="absolute right-0 top-0"/>
        <div>
            <span class="text-md">Account Information</span>
            <div class="flex flex-col mt-3">
                <div class="mb-2 flex flex-col">
                    <x-form-input-label class="text-sm">Username</x-form-input-label>
                    <x-form-input wire:model="username" ></x-form-input>
                    <x-error error="username"/>
                </div>      
                <div class="mb-2 flex flex-col">
                    <x-form-input-label>Email</x-form-input-label>
                    <x-form-input wire:model="email"  ></x-form-input>
                    <x-error error="email"/>
                </div>       
            </div>
        </div>
        <div class="flex justify-center mt-2">
            <x-button>Save</x-button>
        </div>

    </form>
</div>