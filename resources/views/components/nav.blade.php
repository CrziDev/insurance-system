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
                }elseif(request()->user()->role == 3){
                    echo 'Customer';
                }else{
                    echo 'Admin';
                }
            @endphp
        </div>
    </div>

    <div class="flex items-center space-x-5">
        <livewire:notification-bell/>

        <div class="rounded-full w-10 h-10 bg-red-100">
            <img class="object-fill rounded-full" src="{{Vite::asset('resources/images/profile.png')}}" alt="">
        </div>
    </div>
</nav>


