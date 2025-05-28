<div>
    <div x-data="{ open: false, imageUrl: '' }" class="absolute px-4 py-3 inset-x-0 mx-auto mt-[50px] max-w-2xl border bg-white rounded-lg">
        <div class="h-full flex flex-col items-center justify-between text-center">
            <div>
                <p class="text-[28px] text-gray-500">Upload documents to claim</p>
                <p class="italic text-sm text-gray-500 pb-5">(Organized by primary and secondary requirements)</p>
            </div>

            <!-- Primary Requirements -->
            <div class="w-full mb-4">
                <p class="font-semibold text-gray-700 text-left">Primary Requirements (e.g., Valid IDs)</p>
                <div class="border-dashed border-4 w-full h-[200px] flex flex-col justify-center items-center space-y-2">
                    @if ($primaryPhotos)
                        <div class="flex justify-start space-x-3 overflow-x-scroll w-[95%]">
                            @foreach($primaryPhotos as $index => $photo)
                                <div class="relative">
                                    <img class="rounded w-[100px] h-[100px] cursor-pointer"
                                        src="{{ $photo->temporaryUrl() }}"
                                        @click="imageUrl='{{ $photo->temporaryUrl() }}'; open=true">
                                    <button wire:click.prevent="removePrimary({{ $index }})"
                                            class="absolute top-0 right-0 bg-red-600 text-white rounded-full px-2 text-xs">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <i class="fa-solid fa-cloud-arrow-up text-[50px] text-gray-500"></i>
                    @endif
                    <input type="file" id="primary-upload" style="display: none;" wire:model="primaryPhotos" multiple>
                    <button onclick="document.getElementById('primary-upload').click();"
                            class="border bg-sky-500 text-white px-3 py-1 rounded-md">Browse Primary</button>
                </div>
            </div>

            <!-- Secondary Requirements -->
            <div class="w-full mb-4">
                <p class="font-semibold text-gray-700 text-left">Secondary Requirements (e.g., OR/CR, Policy, Police Report)</p>
                <div class="border-dashed border-4 w-full h-[200px] flex flex-col justify-center items-center space-y-2">
                    @if ($secondaryPhotos)
                        <div class="flex justify-start space-x-3 overflow-x-scroll w-[95%]">
                            @foreach($secondaryPhotos as $index => $photo)
                                <div class="relative">
                                    <img class="rounded w-[100px] h-[100px] cursor-pointer"
                                        src="{{ $photo->temporaryUrl() }}"
                                        @click="imageUrl='{{ $photo->temporaryUrl() }}'; open=true">
                                    <button wire:click.prevent="removeSecondary({{ $index }})"
                                            class="absolute top-0 right-0 bg-red-600 text-white rounded-full px-2 text-xs">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <i class="fa-solid fa-cloud-arrow-up text-[50px] text-gray-500"></i>
                    @endif
                    <input type="file" id="secondary-upload" style="display: none;" wire:model="secondaryPhotos" multiple>
                    <button onclick="document.getElementById('secondary-upload').click();"
                            class="border bg-sky-500 text-white px-3 py-1 rounded-md">Browse Secondary</button>
                </div>
            </div>

            <div class="w-full flex justify-center items-end gap-3">
                <button wire:click="fileUpload"
                        class="px-3 py-1 mt-2 rounded-md bg-lime-500 text-white border"
                        :disabled="!@this.primaryPhotos.length && !@this.secondaryPhotos.length">
                    Submit
                </button>
                <button wire:click="cancelClaim"
                        class="px-3 py-1 mt-2 rounded-md bg-red-500 text-white border">
                    Cancel
                </button>
            </div>
        </div>

        <!-- Modal for Image Preview -->
        <div x-show="open" x-cloak x-transition class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-black bg-opacity-70 absolute inset-0" @click="open = false"></div>
            <div class="bg-white p-4 rounded-lg relative z-10">
                <span class="absolute top-2 right-2 cursor-pointer text-xl font-bold" @click="open = false">&times;</span>
                <img :src="imageUrl" class="max-w-full h-auto" alt="Image Preview">
            </div>
        </div>
    </div>

    <!-- Ensure this is in your <head> or Tailwind config -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</div>