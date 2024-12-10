<div x-data="{ open: false, imageUrl: '' }" class="absolute px-4 py-3 inset-x-0 mx-auto mt-[50px] max-w-2xl border bg-white rounded-lg">
    <div class="h-full flex flex-col items-center justify-between text-center">
        <div>
            <p class="text-[28px] text-gray-500">Provide Scanned Proofs</p>
            <p class="italic text-sm text-gray-500">(example: Police Report)</p>
        </div>
        <div class="border-dashed border-4 w-full h-[330px] flex flex-col justify-center space-y-2 items-center">
            @if ($photos) 
            <div class="flex justify-start space-x-5 overflow-x-scroll w-[95%]">
                    @foreach($photos as $photo)
                        <img class="rounded w-[150px] h-[150px] mt-5 block cursor-pointer" 
                             src="{{ $photo->temporaryUrl() }}" 
                             @click="imageUrl='{{ $photo->temporaryUrl() }}'; open=true">
                    @endforeach       
                </div>
            @else
                <i class="fa-solid fa-cloud-arrow-up text-[100px] text-gray-500"></i>
            @endif 
            <div>
                <input type="file" id="file-upload" style="display: none;" wire:model="photos" multiple />
                <button onclick="document.getElementById('file-upload').click();" 
                        class="border bg-sky-500 text-white px-3 py-1 mt-2 mb-5 rounded-md">Browse</button>
            </div>
        </div>
        <div class="w-full flex justify-center  items-end gap-3">
            <button wire:click="fileUpload()" 
                    class="px-3 py-1 mt-2 rounded-md bg-lime-500 text-white border" 
                    :disabled="!@this.photos.length">
                Submit
            </button>
            <button class="px-3 py-1 mt-2 rounded-md bg-red-500 text-white border">Cancel</button>
        </div>
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
