<div>
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4 border-b pb-3">
        <x-table-title class="text-lime-600">{{ $tableTitle }}</x-table-title>

        <div class="text-xs pr-2 flex space-x-2">
            <select 
                wire:model="status"  
                wire:change="filterStatus($event.target.value)" 
                class="px-2 py-1 text-xs border rounded text-gray-500 border-lime-600"
            >
                <option value="" selected>All</option>
                <option value="1">Approved</option>
                <option value="4">Pending</option>
                <option value="3">Expiring</option>
                <option value="2">Expired</option>
            </select>

            <div class="border-2 border-lime-600 rounded-md flex items-center pr-2">
                <input 
                    wire:model.live="search" 
                    id="searchBar" 
                    type="text" 
                    placeholder="Search here.." 
                    class="px-2 py-2 rounded-md focus:outline-none"
                >
                <i class="fa-solid fa-magnifying-glass text-lime-600"></i>
            </div>
        </div>
    </div>

    {{-- Table/List --}}
    <div class="h-full overflow-x-auto">
        <div class="flex flex-col space-y-2 w-full">
            @forelse ($data as $row)
                <div 
                    wire:key="{{ $row->id }}" 
                    wire:click="selectRow({{ $row->id }})"
                    class="flex items-center border px-3 rounded-md py-3 hover:bg-slate-200 cursor-pointer"
                >
                    {{-- Policy Info --}}
                    <div class="w-full border-r flex items-center space-x-2">
                        <img src="{{ Vite::asset('resources/images/insurance1.png') }}" class="w-[28px] h-[23px]" alt="">
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm font-bold">{{ $row->policy?->name ?? 'Life Policy' }}</p>
                            <p class="text-xs">{{ $row->user->customer[0]?->full_name }}</p>
                        </div>
                    </div>

                    {{-- Contact Info --}}
                    <div class="w-full border-r px-5">
                        <div class="flex flex-col space-y-1">
                            <p class="text-xs">{{ $row->user->customer[0]?->phone_number }}</p>
                            <p class="text-xs">{{ $row->user->email }}</p>
                        </div>
                    </div>

                    {{-- Policy Type --}}
                    <div class="w-full border-r text-center">
                        <p class="text-sm font-bold">{{ $row->policy?->type ?? 'Life Policy' }}</p>
                        <p class="text-xs">Policy Type</p>
                    </div>

                    {{-- Date Requested --}}
                    <div class="w-full border-r text-center">
                        <p class="text-sm font-bold">{{ $row->created_at_format }}</p>
                        <p class="text-xs">Date requested</p>
                    </div>

                    {{-- Status --}}
                    <div class="w-full text-center pl-10">
                        <p class="text-sm font-semibold text-{{ lcfirst($row->status_description) }}">
                            {{ $row->status_description }}
                        </p>
                        <p class="text-xs">Status</p>
                    </div>
                </div>
            @empty
                <div class="flex justify-center items-center h-48">
                    <p class="text-lg font-semibold text-gray-500">No Pending Request</p>
                </div>
            @endforelse
        </div>

        {{-- Modals --}}
        <x-modal name="pending-details">
            @if($selectedRow)
                @if($selectedRow->policy->type === "Non-life-type")
                    <livewire:show-pending :client="$selectedRow" key="{{ $selectedRow->id }}" />
                @elseif($selectedRow->policy->type === "Life Policy")
                    <livewire:update-life-insurance-form :editable="true" :selectedRow="$selectedRow" key="{{ $selectedRow->id }}" />
                @endif
            @endif
        </x-modal>

        <x-modal name="show-status-details">
            @if($selectedRow)
                <livewire:show-other-status :selected="$selectedRow" key="{{ $selectedRow->id }}" />
            @endif
        </x-modal>

        <x-modal name="pending-form">
            @if($selectedRow && $selectedRow->policy->type === "Non-life-type")
                <livewire:update-non-life-insurance-form :selectedRow="$selectedRow" />
            @endif
        </x-modal>

        <x-modal name="preview-form">
            @if($selectedRow && $selectedRow->policy->type === "Non-life-type")
                <livewire:preview-non-life-form :selectedRow="$selectedRow" />
            @endif
        </x-modal>
    </div>
</div>
