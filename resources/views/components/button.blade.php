@props(['icon'=>false])

<button {{$attributes->merge(['class'=>'bg-green text-white rounded-md py-1 px-4'])}}{{$attributes}}>

@if($icon == "add")
<i class="fa-regular fa-square-plus mr-2"></i>
@endif
{{$slot}}

</button>
