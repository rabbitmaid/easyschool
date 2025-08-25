

<x-auth page-title="{{ $pageTitle }}" site-title="{{ $siteTitle['value'] }}">

    <div class="container mx-auto flex flex-col justify-center items-center min-h-screen px-5 md:px-0">

        
        <form action="{{ route('admin.auth') }}" class="bg-white p-5 rounded-md w-full md:w-96" method="POST">
            @csrf

            <h1 class="text-center mb-6 text-3xl font-semibold flex justify-center content-center">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                  </svg>
                  <span class="ml-2">Master Login</span>
            </h1>

            @error('email')
                <x-alert-failure message="{{ $message }}" />
            @enderror

            @error('password')
                <x-alert-failure message="{{ $message }}" />
            @enderror

            <div class="form-group mb-4 w-full">
                <label for="email">Email Address <span class="text-red-500">*</span> </label>
                <input class="p-2 mt-3 rounded-md w-full border border-[#3b7ddd]" id="email" name="email" type="email" placeholder="Email Address" value="{{ old('email') }}">
            </div>

           <div class="form-group mb-4 w-full">
                <label for="password">Password <span class="text-red-500">*</span></label>
                <input class="p-2 mt-3 rounded-md w-full border border-[#3b7ddd]" id="password" name="password" type="password" placeholder="Password">
           </div>

            {{-- <div class="form-group mb-4 w-full">
                <input type="checkbox" class="mb-4 p-2 bg-[#3b7ddd]" name="remember" id="remember_me"> <label for="remember_me">Remember Me</label>
            </div> --}}

            <button type="submit" class="bg-[#3b7ddd] hover:bg-blue-500 transition-all w-full p-2 rounded-md text-white">Login</button>

        </form>


    </div>

  
</x-auth>

