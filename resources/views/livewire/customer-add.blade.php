  
<div  x-data @click.outside="show = false" class="absolute max-h-[550px] px-4 shadow-lg py-3 z-50 inset-x-0 mx-auto  mt-[50px] max-w-lg border bg-gray-50 rounded-lg overflow-x-auto">
    <form 
        wire:submit="save" 
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
                <div x-data="{ passwordShow: false }" class="mb-4 flex flex-col">
                    <!-- Password Input -->
                    <x-form-input-label>Password</x-form-input-label>
                    <div class="relative">
                        <input wire:model="password" :type="passwordShow ? 'text' : 'password'" 
                            class="py-2 px-3 w-full text-xs border rounded text-gray-500 border-gray-300 focus:ring-2 focus:ring-blue-500"
                            wire:model="password" type="password" placeholder="Enter password">
                        <x-error type="password" error="password"/>
                        <button type="button" @click="passwordShow = !passwordShow" 
                            class="absolute text-xs right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <span x-text="passwordShow ? 'Hide' : 'Show'"></span>
                        </button>
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
        <div class="border border-gray-300 w-full my-5"></div>
        <div>
            <span class="text-md">Customer Information</span>
            <div class="grid grid-cols-3 space-x-2 mt-3">
                <div class="mb-2  flex flex-col">
                    <x-form-input-label>First Name</x-form-input-label>
                    <x-form-input wire:model="firstName"  ></x-form-input>
                    <x-error error="firstName"/>
                </div>           
                <div class="mb-2  flex flex-col">
                    <x-form-input-label>Last Name</x-form-input-label>
                    <x-form-input wire:model="lastName" ></x-form-input>
                    <x-error error="lastName"/>
                </div>

                <div class="flex space-x-2">
                    <div class="mb-2 w-[47%] flex flex-col" >
                        <x-form-input-label>M.I</x-form-input-label>
                        <x-form-input wire:model="middleInitial" ></x-form-input>
                        <x-error error="middleInitial"/>
                    </div>
                    <div class="mb-2 w-[47%] flex flex-col">
                        <x-form-input-label >Ext</x-form-input-label>
                        <x-form-input wire:model="nameExtention"  ></x-form-input>
                        <x-error error="nameExtention"/>
                    </div> 
                </div>             
            </div>
          
            <div class="grid grid-cols-2 gap-2">
                <div class="mb-2 flex flex-col justify-between">
                    <x-form-input-label>Phone Number (format +69XXXXXXXX)</x-form-input-label>
                    <x-form-input wire:model="phoneNumber" class="w-full" />
                    <x-error error="phoneNumber"/>
                </div>     
                <div class="mb-2 flex flex-col justify-between">
                    <x-form-input-label>Profession</x-form-input-label>
                    <x-form-input wire:model="profession" class="w-full" />
                    <x-error error="profession"/>
                </div>
            </div>
         
            <div class="flex space-x-5">
                <div class="mb-2 w-[100%] flex flex-col" >
                    <x-form-input-label>Address</x-form-input-label>
                    <x-form-input wire:model="address"  ></x-form-input>
                    <x-error error="address"/>
                </div>
            </div>           
        </div>
 
        <div class="flex justify-center mt-2">
            <x-button>Register</x-button>
        </div>

    </form>
</div>