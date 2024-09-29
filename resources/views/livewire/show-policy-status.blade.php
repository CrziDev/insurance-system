<div  class="absolute px-4 py-3 inset-x-0 mx-auto mt-[50px] max-w-6xl min-h-[400px] border bg-white rounded-lg">
   
<div class="flex justify-between">

    <h1 class="mb-2 font-bold text-lime-600">
        {{$fullName}}
    </h1>
    <x-close-modal-icon />
</div>
    <table class="text-sm table-fixed border-collapse border border-lime-500 w-full ">
        <thead>
            <tr>
                <th class="border border-lime-500 bg-lime-600 text-white">Policy No.</th>
                <th class="border border-lime-500 bg-lime-600 text-white">Date effective</th>
                <th class="border border-lime-500 bg-lime-600 text-white">Expiration</th>
                <th class="border border-lime-500 bg-lime-600 text-white">Policy</th>
                <th class="border border-lime-500 bg-lime-600 text-white">Type</th>
                <th class="border border-lime-500 bg-lime-600 text-white">Status</th>
                <th class="border border-lime-500 bg-lime-600 text-white">Action</th>
                <th class="border border-lime-500 bg-lime-600 text-white">View</th>
            </tr>
        </thead>

        <tbody id="transactionTableBody">
            @foreach($data as $row)
            <tr wire:key="$row->id">
                <td class="py-3 border border-lime-500 text-center">001</td>
                <td class="py-3 border border-lime-500 text-center">{{$row->date_effect_format}}</td>
                <td class="py-3 border border-lime-500 text-center">{{$row->date_expiration_format}}</td>
                <td class="py-3 border border-lime-500 text-center">{{$row->Policy->name}}</td>
                <td class="py-3 border border-lime-500 text-center">{{$row->Policy->type}}</td>
                <td class="py-3 border border-lime-500  text-{{lcfirst($row->status_description)}} text-center">{{$row->status_description}}</td>
                <td class="py-3 border border-lime-500 text-center">
                    <button class="  w-[100px] text-white bg-amber-600 p-1 font-semibold rounded-md">Renew</button>
                </td>
                <td class="py-3 border border-lime-500 text-center">
                    <button class="  w-[100px] bg-lime-600 text-white  p-1 font-semibold rounded-md" wire:click="selectRow({{$row}})" >View</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative inline-block text-left mt-5 text-sm">
        <button @click="isOpen = ! isOpen"  class="px-4 py-2 bg-gray-500 text-white rounded-md">
            <i class="fa-solid fa-square-plus mr-2"></i> Create new Policy
        </button>
        <div x-cloak x-show="isOpen || openedWithKeyboard" class="absolute mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="mainButton">
                <button id="nonLifeBtn" wire:click="addInsurance('non-life')" class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100">Non-Life
                    Policy</button>
                <button id="lifePolicyBtn" class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100">Life
                    Policy</button>
            </div>
        </div>
    </div>
    
    <x-modal-child name="view-insurance">   
        @if($selectedRow)
            <livewire:update-non-life-insurance-form :selectedRow="$selectedRow" :policyId="$selectedRow->type_id" />    
        @endif
    </x-modal-child>

    <x-modal-child name="add-insurance">    
        @if($addSelected)  
            <livewire:add-non-life-insurance-form modal="-child" :userId="$selectedCustomer->user->id"/>    
        @endif
    </x-modal-child>
</div>
