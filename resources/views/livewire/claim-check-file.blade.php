<div x-data="{ open: false, imageUrl: '' }" class="absolute px-4 py-3 inset-x-0 mx-auto mt-[50px] max-w-2xl border bg-white rounded-lg">

    <div class="h-full flex flex-col items-center justify-between text-center">
        <p class="text-[28px] text-gray-500">Provided Proofs</p>

        {{-- Primary --}}
        <div class="w-full">
            <h3 class="text-left font-semibold text-gray-600 text-md mt-3">Primary Requirements (e.g., Valid IDs)</h3>
            <div class="flex justify-start space-x-5 overflow-x-scroll w-[95%] border-dashed border-4 p-4">
                @forelse ($primaryAttachments as $photo)
                    <img class="rounded w-[150px] h-[150px] cursor-pointer"
                         src="{{ asset('storage/photos/' . $photo) }}"
                         @click="imageUrl='{{ asset('storage/photos/' . $photo) }}'; open=true">
                @empty
                    <p class="text-sm italic text-gray-400">No primary attachments.</p>
                @endforelse
            </div>
        </div>

        {{-- Secondary --}}
        <div class="w-full mt-6">
            <h3 class="text-left font-semibold text-gray-600 text-md mt-3">Secondary Requirements (e.g., OR/CR, Policy, Police Report)</h3>
            <div class="flex justify-start space-x-5 overflow-x-scroll w-[95%] border-dashed border-4 p-4">
                @forelse ($secondaryAttachments as $photo)
                    <img class="rounded w-[150px] h-[150px] cursor-pointer"
                         src="{{ asset('storage/photos/' . $photo) }}"
                         @click="imageUrl='{{ asset('storage/photos/' . $photo) }}'; open=true">
                @empty
                    <p class="text-sm italic text-gray-400">No secondary attachments.</p>
                @endforelse
            </div>
        </div>

        {{-- Buttons --}}
        @if($transaction->status == 5 && (auth()->user()->role == 1 || auth()->user()->role == 2))
            <div class="w-full flex justify-center items-end gap-3 mt-5">
                <button wire:click="approveClaim()" class="px-3 py-1 rounded-md bg-lime-500 text-white border">Approve</button>
                <button wire:click="cancelClaim()" class="px-3 py-1 rounded-md bg-red-500 text-white border">Cancel</button>
            </div>
        @endif
    </div>

    {{-- Image Modal --}}
    <div x-show="open" @click.away="open = false" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-black bg-opacity-70 absolute inset-0"></div>
        <div class="bg-white p-4 rounded-lg relative">
            <span class="absolute top-2 right-2 cursor-pointer text-2xl font-bold" @click="open = false">&times;</span>
            <img :src="imageUrl" class="max-w-full h-auto" alt="Preview">
        </div>
    </div>
</div>
