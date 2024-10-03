<form action="/logout" method="POST">         
    @csrf      
    <div class="flex items-center py-2 pl-10">
        <img class="w-[20px] h-[20px] mr-4" src="{{ Vite::asset('resources/images/dashboard.png') }}" alt="Logout Icon">
        <button type="submit">{{$slot}}</button>
    </div>                      
</form>