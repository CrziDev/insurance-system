@props(['error'=>'false'])

<div class="flex flex-col space-y-1">
    <label class="text-xs font-sm">{{$slot}}</label>
    <input {{$attributes}} class="px-2 py-1 text-xs  border rounded text-gray-500" type="text">
    <x-error error="{{$error}}"/>
</div>