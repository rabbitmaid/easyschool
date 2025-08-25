<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>


        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Profile Information</h3>

                        <form action="{{ route('admin.teacher.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-12 col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="firstname">First Name</label>
                                        <input type="text" name="firstname" id="firstname"
                                            value="{{ old('firstname') }}" class="form-control w-100" />

                                        @error('firstname')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}"
                                            class="form-control w-100" />

                                        @error('lastname')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>


                                </div>

                            </div>

                            {{-- --------------------------- --}}

                            <div class="row">

                                <div class="col-12 col-md-6">


                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                                            class="form-control w-100" />

                                        @error('username')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-12 col-md-6">


                                    <div class="form-group mb-3">
                                        <label for="email">Email Address</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="form-control w-100" />

                                        @error('email')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- --------------------------- --}}


                            <div class="row">

                                <div class="col-12 col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            value="{{ old('date_of_birth') }}" class="form-control w-100" />

                                        @error('date_of_birth')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-12 col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                                            class="form-control w-100" />

                                        @error('address')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                            </div>


                            {{-- --------------------------- --}}


                            <div class="row">

                                <div class="col-12 col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="phone_number" name="phone_number" id="phone_number"
                                            value="{{ old('phone_number') }}" class="form-control w-100" />

                                        @error('phone_number')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-12 col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="course">Select Course</label>
                                        <select class="form-select mb-3" name="course_id" id="course">
                                            <option disabled>Select a Course</option>
        
                                            @if(isset($courses) && !empty($courses))
        
                                            @foreach ($courses as $course)
        
                                                  <option value="{{$course->id }}">{{ $course->name }}</option>
       
                                            @endforeach
        
                                            @else
        
                                            <option selected disabled>No Course Found</option>
        
                                            @endif
                                        </select>
        
                                        @error('course_id')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                </div>



                            </div>

                            </div>

                            {{-- ------------------------------- --}}

                            <div class="row">

                                <div class="col-12 col-md-4">

                                    <div class="form-group mb-3">
                                        <label for="status">Select Status</label>
                                        <select class="form-select" name="status_id" id="status">
                                            <option selected disabled>Select a Status</option>

                                            @if(isset($statuses) && !empty($statuses))

                                            @foreach ($statuses as $status)
                                                <option value="{{$status->id }}">{{ $status->name }}</option>
                                            @endforeach

                                            @else

                                            <option selected disabled>No Status Found</option>

                                            @endif
                                        </select>

                                        @error('status_id')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-12 col-md-4">

                                    <div class="form-group mb-3">
                                        <label for="gender">Gender</label>
                                        <select class="rounded form-select" name="gender_id" id="gender">
                                            <option selected disabled>Select a Gender</option>

                                            @if(isset($genders) && !empty($genders))

                                            @foreach ( $genders as $gender )

                                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>

                                            @endforeach

                                            @endif

                                        </select>

                                        @error('gender_id')
                                        <x-alert-failure message="{{ $message }}" />
                                        @enderror
                                    </div>

                                </div>



                                <div class="col-12 col-md-4">

                                    <div class="form-group mb-3">
                                        <label for="role">Select an Administrator Role</label>
                                        <select class="form-select mb-3" name="role_id" id="role">
                                            <option disabled>Select a Role</option>
        
                                            @if(isset($roles) && !empty($roles))
        
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id }}">{{ $role->name }}</option>
                                            @endforeach
        
                                            @else
        
                                            <option selected disabled>No Role Found</option>
        
                                            @endif
                                        </select>
        
                                        @error('role_id')
                                        <div class="alert alert-danger p-2 mt-2">
                                            <small>
                                                <p class="mb-0">{{ $message }}</p>
                                            </small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>


                            </div>



                            



                            <div class="form-group mb-3">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control w-100" />

                                @error('password')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror

                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control w-100" />

                                @error('password_confirmation')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Add Administrator / Teacher</button>
                            </div>

                        </form>



                    </div>

                </div>


            </div>


        </div>

    </div>


</x-master-admin>