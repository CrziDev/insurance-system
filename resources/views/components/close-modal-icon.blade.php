@props(['modal'=>''])

<div @click="$dispatch('close-modal{{$modal}}')" {{$attributes->merge(['class'=>'mb-3 bg-gray-400/90 text-white text-center rounded-full w-5 h-5 text-sm  hover:bg-gray-400/80 cursor-pointer'])}}>X</div>
    