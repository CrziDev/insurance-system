@props(['active' => false,'iconImage'=>null,'iconLink'=>null])

<a class="{{$active? 'border-opacity-100 bg-white/15 text-white':'border-opacity-0 text-white/60'}} border-l-4 border-orange flex items-center py-3 pl-10"  {{ $attributes }}>
    
    @if($iconImage)
        <img class="w-[20px] h-[20px] mr-4" src="{{Vite::asset('resources/images/'. $iconImage)}}" alt="">
    @endif

    @if($iconLink)
    <i class="text-[20px] mr-4 w-[20px]  fa-solid {{$iconLink}} text-white"></i>
    @endif
    <p>{{$slot}}</p>
</a>