@props(['error'])


@if($error == 'password' || $error == 'confirm_password' || $error == 'email' || $error == 'phoneNumber' || $error=="username")
    @error($error)<span class="text-xs text-red-500">{{$message}}</span>@enderror
@else
    @error($error)<span class="text-xs text-red-500">{{$message}}</span>@enderror
@endif
