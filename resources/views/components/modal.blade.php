@props(['name'])

<div 
    x-data="{show:false, name:'{{$name}}'}"
    x-show="show"
    x-on:open-modal.window = "show=($event.detail.name == name)"
    x-on:close-modal.window = "show=false"
    x-transition
    class="fixed inset-0 z-40 backdrop-blur bg-gray-400/10">

        {{$slot}}

</div>

