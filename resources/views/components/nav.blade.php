<nav class="flex justify-between items-center px-5 py-3 border-b border-black/10 shadow-md bg-white">
    <div>
        <div class="text-md font-semibold flex space-x-1">
            <span class="font-semibold">
                {{auth()->user()->greeting}},
            </span>
            <span >{{auth()->user()->username}}</span>
        </div>
    
        <div>
            @php
                if(request()->user()->role == 2){
                    echo 'Staff';
                }else{
                    echo 'Admin';
                }
            @endphp
        </div>
    </div>

    <div class="flex items-center space-x-5">
        <div x-data="{isOpen:false}" class="relative">
            <div>
                <img @click="isOpen = !isOpen" class="w-5 h-5 relative" src="{{Vite::asset('resources/images/bell.png')}}" alt="">
                <span class="absolute top-0 right-[-3.5px] text-red-600 font-bold text-[10px]">{{auth()->user()->notifications->count()}}</span>
            </div>
            <div x-cloak x-show="isOpen" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false " class="absolute top-7 z-50 right-0 flex w-full max-h-[20rem] min-w-[15rem] flex-col overflow-y-scroll rounded-md border border-neutral-300 bg-neutral-50 p-1.5" role="menu">
         
            @foreach(auth()->user()->notifications as $notification)
                    <div class="text-[10px] p-2 mb-2 bg-gray-200">
                        <p>
                            <span>Event:<span>
                           {{ $notification->data['event']}}
                        </p>
                        <p>
                            <span>Type:<span>
                            {{$notification->data['type']??null}}
                        </p>
                        <p>
                            <span>Requestor:<span>
                            {{$notification->data['requestor']}}
                        </p>
                        <p>
                            <span>Date:<span>
                            {{$notification->data['date']}}
                        </p>
                    </div>
            @endforeach

            </div>
        </div>

        
        <div class="rounded-full w-10 h-10 bg-red-100">
            <img class="object-fill rounded-full" src="{{Vite::asset('resources/images/profile.png')}}" alt="">
        </div>
    </div>
</nav>


