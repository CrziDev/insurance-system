@props(['icon' => false, 'color' => 'bg-green'])  {{-- Added color as a prop --}}

<button {{$attributes->merge(['class' => "$color text-white rounded-md py-1 px-4"])}}>

    @if($icon == "add")
        <i class="fa-regular fa-square-plus mr-2"></i>
    @endif
    {{$slot}}
</button>
