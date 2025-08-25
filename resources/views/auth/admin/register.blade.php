<x-auth page-title="{{ $pageTitle }}" site-title="{{ $siteTitle}}">

    <div class="container mx-auto flex flex-col justify-center items-center min-h-screen px-5 py-5 md:px-0">


        <form action="{{ route('admin.create') }}" class="bg-white p-5 rounded-md w-full md:w-[500px]" method="POST">
            @csrf

            <h1 class="text-center mb-6 text-3xl font-semibold flex justify-center content-center">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-9 h-9">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>

                <span class="ml-2">New Master Account</span>
            </h1>

            {{-- Row --}}
            <div class="md:flex justify-between gap-2">

                <div class="form-group mb-4 w-full">
                    <label for="username">Username<span class="text-red-500">*</span> </label>
                    <input class="p-2 mt-3 rounded-md w-full border border-[#3b7ddd]" id="username" name="username"
                        type="text" placeholder="Username" value="{{ old('username') }}">
    
                    @error('username')
                    <x-alert-failure message="{{ $message }}" />
                    @enderror
    
    
                </div>
    
                <div class="form-group mb-4 w-full">
                    <label for="email">Email Address <span class="text-red-500">*</span> </label>
                    <input class="p-2 mt-3 rounded-md w-full border border-[#3b7ddd]" name="email" id="email" type="email"
                        placeholder="Email Address" value="{{ old('email') }}">
    
                    @error('email')
                    <x-alert-failure message="{{ $message }}" />
                    @enderror
    
                </div>

            </div>

            {{-- Row --}}
            <div class="md:flex justify-between gap-2">

                <div class="form-group mb-4 w-full">
                    <label for="password">Password <span class="text-red-500">*</span></label>
                    <input class="p-2 mt-3 rounded-md w-full border border-[#3b7ddd]" name="password" id="password"
                        type="password" placeholder="Password">
    
                    @error('password')
                    <x-alert-failure message="{{ $message }}" />
                    @enderror
    
                </div>
    
                <div class="form-group mb-4 w-full">
                    <label for="password_confirmation">Password Confirmation <span class="text-red-500">*</span></label>
                    <input class="p-2 mt-3 rounded-md w-full border border-[#3b7ddd]" name="password_confirmation"
                        id="password_confirmation" type="password" placeholder="Confirm Password">
    
                    @error('password_confirmation')
                    <x-alert-failure message="{{ $message }}" />
                    @enderror
    
                </div>

            </div>



            {{-- Row --}}
            <div class="md:flex justify-between gap-2">

                <div class="form-group mb-4 w-full">
                    <label for="date_of_birth">Date of Birth <span class="text-red-500">*</span></label>
                    <input class="p-2 mt-3 rounded-md w-full border border-[#3b7ddd]" name="date_of_birth"
                        id="date_of_birth" type="date" placeholder="Date of Birth">
    
                    @error('date_of_birth')
                    <x-alert-failure message="{{ $message }}" />
                    @enderror
    
                </div>
    
                <div class="form-group mb-4 w-full">
                    <label for="course">Course <span class="text-red-500">*</span></label>
                    <select class="w-full p-2 mt-3 rounded-md bg-white border border-[#3b7ddd]" name="course" id="">
                        <option selected disabled>Select a Courses</option>
    
                        @if(isset($courses) && !empty($courses))
    
                        @foreach ( $courses as $course )
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
    
                        @endif
    
                    </select>
    
                    @error('course')
                    <x-alert-failure message="{{ $message }}" />
                    @enderror
                </div>


            </div>


            <div class="form-group mb-4 w-full">
                <label for="role">Role <span class="text-red-500">*</span></label>
                <select class="w-full p-2 mt-3 rounded-md bg-white border border-[#3b7ddd]" name="role" id="">
                    <option selected disabled>Select a Role</option>

                    @if(isset($roles) && !empty($roles))

                    @foreach ( $roles as $role )
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach

                    @endif

                </select>

                @error('role')
                <x-alert-failure message="{{ $message }}" />
                @enderror
            </div>



            <div class="form-group mb-4 w-full">
                <label for="gender">Gender <span class="text-red-500">*</span></label>
                <select class="w-full p-2 mt-3 rounded-md bg-white border border-[#3b7ddd]" name="gender" id="">
                    <option selected disabled>Select a Gender</option>

                    @if(isset($genders) && !empty($genders))

                    @foreach ( $genders as $gender )
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                    @endforeach

                    @endif

                </select>

                @error('gender')
                <x-alert-failure message="{{ $message }}" />
                @enderror
            </div>



            <button type="submit"
                class="bg-[#3b7ddd] hover:bg-blue-500 transition-all w-full p-2 rounded-md text-white">Register</button>

        </form>


    </div>


</x-auth>