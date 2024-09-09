<x-layout>

    <form method="post" action="/login">
        @csrf


        @error('error')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
        @enderror

        <div>
            <label>Username</label>
            <input type="text" name="username"> 
        </div>

        @error('username')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
        @enderror
        
        <div>
            <label>Password</label>
            <input type="password" name="password"> 
        </div>
        @error('password')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
        @enderror

        <button type="submit">Submit</button>
    </form>
</x-layout>
