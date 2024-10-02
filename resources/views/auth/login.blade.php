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
                                <x-form-input-w-label error="username" class="border-2 rounded-md px-2 py-1 " name="username">Username</x-form-input-w-label>
                                <x-form-input-w-label error="password" class="border-2 rounded-md px-2 py-1 " name="password">Password</x-form-input-w-label>                         
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
                                <button type="submit" class="w-[200px] py-2 m-auto rounded-[6px] bg-[#90EC48] hover:bg-[#75C138] transition ease-in-out duration-300 font-poppins shadow-[3px_4px_4px_rgba(0,0,0,0.3)]">Login</button>
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
