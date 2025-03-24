  
<div  x-data @click.outside="show = false" class="absolute max-h-[550px] px-4 shadow-lg py-3 z-50 inset-x-0 mx-auto  mt-[50px] max-w-lg border bg-gray-50 rounded-lg overflow-x-auto">
    <form 
        wire:submit="update" 
        class="overflow-x-auto relative"
        >

        <x-close-modal-icon class="absolute right-0 top-0"/>
        <div>
            <span class="text-md">Account Information</span>
            <div class="flex flex-col mt-3">    
                <div x-data="{ passwordShow: false }" class="mb-4 flex flex-col">
                    <!-- Password Input -->
                    <x-form-input-label>Change Password</x-form-input-label>
                    <div class="relative">
                        <input wire:model="password" :type="passwordShow ? 'text' : 'password'" 
                            class="py-2 px-3 w-full text-xs border rounded text-gray-500 border-gray-300 focus:ring-2 focus:ring-blue-500"
                            wire:model="password" type="password" placeholder="Enter password">
                            <button type="button" @click="passwordShow = !passwordShow" 
                            class="absolute text-xs right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <span x-text="passwordShow ? 'Hide' : 'Show'"></span>
                        </button>
                        <x-error type="password" error="password"/>
                    </div>
                </div>

                <div x-data="{ passwordShow: false }" class="mb-4 flex flex-col">
                    <!-- Confirm Password Input -->
                    <x-form-input-label>Confirm Password</x-form-input-label>
                    <div class="relative">
                        <input wire:model="password_confirmation" :type="passwordShow ? 'text' : 'password'" 
                            class="py-2 px-3 w-full  text-xs border rounded text-gray-500 border-gray-300 focus:ring-2 focus:ring-blue-500"
                            wire:model="password_confirmation" type="password" placeholder="Confirm your password">
                        <x-error type="password" error="password_confirmation"/>
                        <button type="button" @click="passwordShow = !passwordShow" 
                            class="absolute text-xs right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <span x-text="passwordShow ? 'Hide' : 'Show'"></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="flex justify-center mt-2">
            <x-button>Save</x-button>
        </div>

    </form>
</div>