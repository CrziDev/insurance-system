  
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
                    <x-form-input wire:model="username" placeholder="Input Username"></x-form-input>
                    <x-error error="username"/>
                </div>      
                <div class="mb-2 flex flex-col">
                    <x-form-input-label>Email</x-form-input-label>
                    <x-form-input wire:model="email" placeholder="Input Email"></x-form-input>
                    <x-error error="email"/>
                </div>       
                <div class="mb-2 flex flex-col">
                    <x-form-input-label>Password</x-form-input-label>
                    <x-form-input type="password" wire:model="password" placeholder="Input Password"></x-form-input>
                    <x-error type="password" error="password"/>
                </div>
                <div class="mb-2 flex flex-col" >
                    <x-form-input-label>Confirm Password</x-form-input-label>
                    <x-form-input type="password" wire:model="password_confirmation" placeholder="Confirm Password"></x-form-input>
                    <x-error error="password_confirmation"/>
                </div>
            </div>
        </div>
        <div class="border border-gray-300 w-full my-5"></div>
        <div>
            <span class="text-md">Staff Information</span>
            <div class="grid grid-cols-3 space-x-2 mt-3">
                <div class="mb-2  flex flex-col">
                    <x-form-input-label>First Name</x-form-input-label>
                    <x-form-input wire:model="firstName" placeholder="Input First Name"></x-form-input>
                    <x-error error="firstName"/>
                </div>           
                <div class="mb-2  flex flex-col">
                    <x-form-input-label>Last Name</x-form-input-label>
                    <x-form-input wire:model="lastName" placeholder="Input Last Name"></x-form-input>
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
                        <x-form-input wire:model="nameExtention" ></x-form-input>
                        <x-error error="nameExtention"/>
                    </div> 
                </div>             
            </div>
          
            <div class="grid grid-cols-2 space-x-2">
                <div class="mb-2 flex flex-col">
                    <x-form-input-label>Phone Number (09xxxxxxxxx)</x-form-input-label>
                    <x-form-input 
                        wire:model="phoneNumber" 
                        placeholder="Input Phone Number" 
                        value="+63" 
                        oninput="if (!this.value.startsWith('+63')) { 
                                    this.value = '+63' + this.value.replace(/[^0-9]/g, '').slice(0, 9); 
                                } else { 
                                    this.value = '+63' + this.value.slice(3).replace(/[^0-9]/g, '').slice(0, 9); 
                                } 
                                if(this.value.length > 12) this.value = this.value.slice(0, 12);" 
                        inputmode="numeric" 
                        class="w-full" />
                    <x-error error="phoneNumber"/>
                </div>     
                <div class="mb-2  flex flex-col">
                    <x-form-input-label>Position</x-form-input-label>
                    <x-form-input wire:model="profession" placeholder="Input Profession"></x-form-input>
                    <x-error error="profession"/>
                </div>
            </div>
         
            <div class="flex space-x-5">
                <div class="mb-2 w-[100%] flex flex-col" >
                    <x-form-input-label>Address</x-form-input-label>
                    <x-form-input wire:model="address" placeholder="Input Address"></x-form-input>
                    <x-error error="address"/>
                </div>
            </div>           
        </div>
        <div class="flex justify-center mt-2">
            <x-button>Add</x-button>
        </div>

    </form>
</div>