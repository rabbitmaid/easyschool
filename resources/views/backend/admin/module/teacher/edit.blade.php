<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>


        <div class="col-12 col-md-4 col-xl-4 col-xxl-4 d-flex">
            <div class="w-100">


                <div class="card">
                    <div class="card-body text-center">


                        <form action="{{ route('admin.teacher.update_profile_image', $teacher->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')


                            @if($teacher->profile_image == NULL)

                            <img src="https://ui-avatars.com/api/?name={{ $teacher->username }}&color=7F9CF5&background=EBF4FF&format=svg"
                                alt="Profile"
                                style="width: 150px; height: 150px; border: 8px solid white; outline: 2px solid #f2f2f2;"
                                class="rounded-circle shadow-lg">

                            @else
                            <div class="mx-auto rounded-circle bg-light shadow-lg"
                                style="width: 150px; height: 150px; overflow: hidden; transition: all 650ms ease-in-out; border: 8px solid white; outline: 2px solid #f2f2f2;">
                                <img src="{{ asset('storage/' . $teacher->profile_image ) }}"
                                    style="object-fit: cover; height: 150px;" class="w-100">
                            </div>

                            @endif


                            <div class="container-fluid mt-4 mb-4">
                                <label for="profile_image" class="text-center w-100 mb-2">Upload a Profile Image</label>
                                <div class="upload-field">
                                    <input name="profile_image" type="file" id="profile_image" class="form-control"
                                        accept="image/*">
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
                        <h2 class="text-center">{{ $teacher->firstname . ' ' . $teacher->lastname }}</h2>
                        <div class="text-center badge bg-primary rounded-pill p-2 w-100">
                            <p class="mb-0 text-uppercase">Current course: {{ $teacher->course->name }}</p>
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

                        <form action="{{ route('admin.teacher.update', $teacher->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group mb-3">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" value="{{ $teacher->firstname }}"
                                    class="form-control w-100" />

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
                                <input type="text" name="lastname" id="lastname" value="{{ $teacher->lastname }}"
                                    class="form-control w-100" />

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
                                <input type="text" name="username" id="username" value="{{ $teacher->username }}"
                                    class="form-control w-100" />

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
                                <input type="email" name="email" id="email" value="{{ $teacher->email }}"
                                    class="form-control w-100" />

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
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    value="{{ $teacher->date_of_birth }}" class="form-control w-100" />

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
                                <input type="text" name="address" id="address" value="{{ $teacher->address }}"
                                    class="form-control w-100" />

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
                                <input type="phone_number" name="phone_number" id="phone_number"
                                    value="{{ $teacher->phone_number }}" class="form-control w-100" />

                                @error('phone_number')
                                <div class="alert alert-danger p-2 mt-2">
                                    <small>
                                        <p class="mb-0">{{ $message }}</p>
                                    </small>
                                </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="status">Select Status</label>
                                <select class="form-select mb-3" name="status_id" id="status">
                                    <option disabled>Select a Status</option>

                                    @if(isset($statuses) && !empty($statuses))

                                    @foreach ($statuses as $status)

                                    @if($teacher->status->id == $status->id)
                                    <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                                    @else
                                    <option value="{{$status->id }}">{{ $status->name }}</option>
                                    @endif

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


                                <div class="form-group mb-3">
                                    <label for="course">Select Course</label>
                                    <select class="form-select mb-3" name="course_id" id="course">
                                        <option disabled>Select a Course</option>

                                        @if(isset($courses) && !empty($courses))

                                        @foreach ($courses as $course)

                                        @if($teacher->course->id == $course->id)
                                        <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                        @else
                                        <option value="{{$course->id }}">{{ $course->name }}</option>
                                        @endif

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


                                <div class="form-group mb-3">
                                    <label for="gender">Gender</label>
                                    <select class="rounded form-select" name="gender_id" id="gender">
                                        <option selected disabled>Select a Gender</option>

                                        @if(isset($genders) && !empty($genders))

                                        @foreach ( $genders as $gender )

                                        @if($teacher->gender->id == $gender->id)
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



                                <div class="form-group mb-3">
                                    <label for="role">Select an Administrator Role</label>
                                    <select class="form-select mb-3" name="role_id" id="role">
                                        <option disabled>Select a Role</option>

                                        @if(isset($roles) && !empty($roles))

                                        @foreach ($roles as $role)

                                        @if($teacher->role->id == $role->id)
                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>

                                        @else
                                        <option value="{{$role->id }}">{{ $role->name }}</option>
                                        @endif


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

                        <form action="{{ route('admin.teacher.update_password', $teacher->id) }}" method="POST">
                            @csrf
                            @method('patch')

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