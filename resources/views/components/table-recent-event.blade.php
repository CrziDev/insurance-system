@props(['data'=>[]])

<div class="w-full flex justify-between flex-col ">
    @foreach($data as $row)
    <div class="flex items-center border px-3 rounded-md mb-2 py-3">
            <div class="w-full">
                <div class="flex align-center space-x-2">
                    <img class="w-[28px] h-[23px]" src="{{Vite::asset('resources/images/insurance1.png')}}" alt="">
                    <div class="flex flex-col space-y-1">
                        <p class="text-xs font-semibold">{{$row->Policy->name}}</p>
                        <p class="text-xs font-semibold">{{$row->user->customer[0]?->full_name}}</p>
                    </div>   
                </div>
            </div>

            <div class="w-full">
                <div class="flex flex-col space-y-1">
                    <p class="text-xs  text-{{lcfirst($row->status_description)}} font-sm text-center">{{$row->status_event}}</p>
                    <p class="text-xs text-center">Status</p>   
                </div>   
            </div>

            <div class="w-full">
                <div class="flex flex-col space-y-1">
                    <p class="text-xs font-sm text-center">{{$row->updated_format}}</p>
                    <p class="text-xs text-center">Date</p>   
                </div>   
            </div>

        </div>  
    @endforeach         
</div>    