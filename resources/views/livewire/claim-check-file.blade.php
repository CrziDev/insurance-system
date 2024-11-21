<div  @click.outside="show = false" x-data="{ open: false, imageUrl: '' }" class="absolute px-4 py-3 inset-x-0 mx-auto mt-[50px] max-w-2xl border bg-white rounded-lg">
    <div class="h-full flex flex-col items-center justify-between text-center">
        <div>
            <p class="text-[28px] text-gray-500">Provided Proofs</p>
        </div>
        <div class="border-dashed border-4 w-full h-[330px] flex flex-col justify-center space-y-2 items-center">
            @if ($photos) 
                <div class="flex justify-start space-x-5 overflow-x-scroll w-[95%]">
                    @foreach($photos as $photo)
                        <img class="rounded w-[150px] h-[150px] mt-5 block cursor-pointer" 
                             src="{{asset('storage/photos/'.$photo) }}" 
                             @click="imageUrl='{{ asset('storage/photos/'.$photo) }}'; open=true" >
                    @endforeach       
                </div>
            @else
                <i class="fa-solid fa-cloud-arrow-up text-[100px] text-gray-500"></i>
            @endif 
        </div>
        @if($transaction->status == 5 && (auth()->user()->role == 1 || auth()->user()->role == 2))
            <div class="w-full flex justify-center items-end gap-3">
                <button wire:click="approveClaim()" class="px-3 py-1 mt-2 rounded-md bg-lime-500 text-white border">Approve</button>
                <button wire:click="cancelClaim()" class="px-3 py-1 mt-2 rounded-md bg-red-500 text-white border">Cancel</button>
            </div>
        @endif
    </div>

    <!-- Modal for Image Preview -->
    <div x-show="open" @click.away="open = false" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-black bg-opacity-70 absolute inset-0"></div>
        <div class="bg-white p-4 rounded-lg relative">
            <span class="absolute top-2 right-2 cursor-pointer" @click="open = false">&times;</span>
            <img x-bind:src="imageUrl" class="max-w-full h-auto" alt="Image Preview">
        </div>
    </div>
</div>
