@props(['error'])


@if($error == 'password' || $error == 'confirm_password' || $error == 'email')
    @error($error)<span class="text-xs text-red-500">{{$message}}</span>@enderror
@else
    @error($error)<span class="text-xs text-red-500">Empty Field</span>@enderror
@endif
