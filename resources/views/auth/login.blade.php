<x-layout>
    <div class="bg-neutral-800 h-screen justify-center items-center flex flex-col py-[20px]">

        <div class="bg-[#ECECEC] relative overflow-hidden h-[643px] w-[950px] rounded-[25px]">

            <div class="flex flex-row items-center h-[100%]">
                <div class="w-[50%]  ml-[20px]">
                    <img class="w-[334px] h-[343px] m-auto" src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
                </div>

                <div class="w-[50%] mr-[40px]">

                    <form method="post" action="/login" class="w-[450px] h-[400px] m-auto border bg-white shadow-[7px_9px_4.3px_rgba(0,0,0,0.3)] rounded-[28px]">
                        @csrf
                        
                        <div class="p-10">
                            <div class="font-bold text-[25px] text-center mb-[10px]">Log In</div>
                                @error('error')
                                    <div class="w-full py-2 px-2 bg-red-400 mb-2">
                                        <p class="text-xs text-white font-semibold mt-1">{{ $message }}</p>
                                    </div>
                                @enderror
                            <div class="mb-[15px] space-y-4">
                                <x-form-input-w-label error="username" class="text-xs border-2 px-2 py-2 rounded-md px-2 py-1 " placeholder="Input Username" name="username">Username</x-form-input-w-label>

                                <div x-data="{ passwordShow: false }" class="mb-4 flex flex-col">
                                    <!-- Password Input -->
                                    <x-form-input-label>Password</x-form-input-label>
                                    <div class="relative">
                                        <input wire:model="password" :type="passwordShow ? 'text' : 'password'" 
                                            class="w-full border-gray-300 focus:none px-2 py-2 text-xs  border-2 rounded-md text-gray-500"
                                            name="password" type="password" placeholder="Enter password">
                                        <x-error type="password" error="password"/>
                                        <button type="button" @click="passwordShow = !passwordShow" 
                                            class="absolute text-xs right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                            <span x-text="passwordShow ? 'Hide' : 'Show'"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between text-[12px] mb-[25px]">
                                <div class="flex flex-row items-center gap-2">
                                    <input type="checkbox" class="ml-[2px] accent-lime-500">
                                    <label for="" class="font-poppins ">Keep me Logged In</label>
                                </div>
                                <div class="flex gap-2">
                                    <label class="">For customers </label>
                                    <span x-data @click="$dispatch('open-modal', { name: 'customer-add' })" class=" cursor-pointer ml-[2px] underline underline-offset-2 text-blue-500">Click Here</span>
                                </div>
                            </div>
                            <div class=" flex justify-center mb-[12px]">
                                <button type="submit" class="w-[200px] py-2 m-auto rounded-[6px] bg-orange hover:bg-[#75C138] text-white transition ease-in-out duration-300 font-poppins shadow-[3px_4px_4px_rgba(0,0,0,0.3)]">Login</button>
                            </div>
                        </div>
            

                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="customer-add">
        <livewire:customer-add></livewire:customer-add>
    </x-modal>
    
</x-layout>
