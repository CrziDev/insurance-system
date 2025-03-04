<div x-data="{ isOpen: false }" class="relative">
    <div>
        <img @click="isOpen = !isOpen; @this.markNotificationsAsRead()" class="w-5 h-5 relative cursor-pointer" src="{{ Vite::asset('resources/images/bell.png') }}" alt="Notification Bell">
        <!-- <span x-show="notificationsCount > 0" class="absolute top-0 right-[-3.5px] text-red-600 font-bold text-[10px]" x-text="notificationsCount"></span> -->
        <span class="absolute top-0 right-[-3.5px] text-red-600 font-bold text-[10px]">{{$notificationsCount}}</span>
    </div>
    
    <div x-cloak x-show="isOpen" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false" class="absolute top-7 z-50 right-0 flex w-full max-h-[20rem] min-w-[15rem] flex-col overflow-y-scroll rounded-md border border-neutral-300 bg-neutral-50 p-1.5" role="menu">
        @foreach($notifications as $notification)
            <div class="text-[10px] p-2 mb-2 bg-gray-200">
                <p><span>Event:</span> {{ $notification->data['event'] }}</p>
                <p><span>Type:</span> {{ $notification->data['type'] ?? null }}</p>
                <p><span>Requestor:</span> {{ $notification->data['requestor'] }}</p>
                <p><span>Date:</span> {{ $notification->data['date'] }}</p>
            </div>
        @endforeach
    </div>
</div>
