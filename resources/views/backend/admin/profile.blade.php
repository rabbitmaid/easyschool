<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}" dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>


        <div class="col-12 col-md-4 col-xl-4 col-xxl-4 d-flex">
            <div class="w-100">

                <div class="card">
                    <div class="card-body text-center">


                        <form action="{{ route('admin.profile_image_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')


                            @if(Auth::guard('admin')->user()->profile_image == NULL)

                            <img src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->username }}&color=7F9CF5&background=EBF4FF&format=svg" alt="Profile" style="width: 150px; height: 150px; border: 8px solid white; outline: 2px solid #f2f2f2;" class="rounded-circle shadow-lg">

                            @else
                            <div class="mx-auto rounded-circle bg-light shadow-lg" style="width: 150px; height: 150px; overflow: hidden; transition: all 650ms ease-in-out; border: 8px solid white; outline: 2px solid #f2f2f2;">
                                <img src="{{ asset('storage/' . Auth::guard('admin')->user()->profile_image ) }}" style="object-fit: cover; height: 150px;" class="w-100">
                            </div>

                            @endif


                            <div class="container-fluid mt-4 mb-4">
                                <label for="profile_image" class="text-center w-100 mb-2">Upload a Profile Image</label>
                                <div class="upload-field">
                                    <input name="profile_image" type="file" id="profile_image" class="form-control" accept="image/*">
                                </div>
                                @error('profile_image')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror

                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </div>


                        </form>

                    </div>
                </div>


                {{-- Other User Information Below profile image --}}
                <div class="card mt-4">

                    <div class="card-body">
                        <h2 class="text-center">{{ Auth::guard('admin')->user()->firstname . ' ' .
                            Auth::guard('admin')->user()->lastname }}</h2>
                        <div class="text-center badge bg-primary rounded-pill p-2 w-100">
                            <p class="mb-0 text-uppercase">Current Course: {{Auth::guard('admin')->user()->course->name }}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-12 col-md-8 col-xl-8 col-xxl-8 d-flex">

            <div class="w-100">

                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Modify Profile Information</h3>

                        <form action="{{ route('admin.profile_update') }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group mb-3">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" value="{{ Auth::guard('admin')->user()->firstname }}" class="form-control w-100" />

                                @error('firstname')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" value="{{ Auth::guard('admin')->user()->lastname }}" class="form-control w-100" />

                                @error('lastname')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="{{ Auth::guard('admin')->user()->username }}" class="form-control w-100" />

                                @error('username')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ Auth::guard('admin')->user()->email }}" class="form-control w-100" />

                                @error('email')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ Auth::guard('admin')->user()->date_of_birth }}" class="form-control w-100" />

                                @error('date_of_birth')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" value="{{ Auth::guard('admin')->user()->address }}" class="form-control w-100" />

                                @error('address')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="phone_number">Phone Number</label>
                                <input type="phone_number" name="phone_number" id="phone_number" value="{{ Auth::guard('admin')->user()->phone_number }}" class="form-control w-100" />

                                @error('phone_number')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="gender">Gender</label>
                                <select class="mt-3 rounded form-select" name="gender_id" id="">
                                    <option selected disabled>Select a Gender</option>

                                    @if(isset($genders) && !empty($genders))

                                    @foreach ( $genders as $gender )

                                    @if(Auth::guard('admin')->user()->gender_id == $gender->id)
                                    <option value="{{ $gender->id }}" selected>{{ $gender->name }}</option>

                                    @else
                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @endif


                                    @endforeach

                                    @endif

                                </select>

                                @error('gender_id')
                                <x-alert-failure message="{{ $message }}" />
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                            </div>

                        </form>



                    </div>

                </div>




                {{-- Password Management Card below --}}



                <div class="card">

                    <div class="card-body">

                        <h3 class="mb-4">Update Password</h3>

                        <form action="{{ route('admin.password_update') }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-3">
                                <label for="new_password">Old Password</label>
                                <input type="password" name="old_password" id="new_password" class="form-control w-100" />

                                @error('old_password')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
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
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control w-100" />

                                @error('password_confirmation')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                            </div>

                        </form>


                    </div>

                </div>


            </div>





        </div>

    </div>


</x-master-admin>
